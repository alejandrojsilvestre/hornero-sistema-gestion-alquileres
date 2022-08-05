<?php

namespace App\Http\Controllers;

use App\Cobro;
use App\Pago;
use App\Gasto;
use App\Impuesto;
use App\Movimiento;
use App\Contrato;
use App\Factura;
use App\AfipInvoice;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use DateTime;
use NumeroALetras;
use App\Mail\ReceiptMail;
use App\Mail\GeneralMail;
use Mail;
use Storage;
use \App\Repositories\InvoiceRepository;

class GestionController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestiones.list');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cobro = new Cobro;
        return view('gestiones.form')
                ->with('cobro',$cobro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cobro  $cobro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cobro = Cobro::find($id);

        $periodo = array($cobro->id => $cobro->periodo_desc);

        $gastos_liquidados = $cobro->gastos_liquidados;
        
        // Inquilinos
        $inquilinos = array();
        foreach ($cobro->contrato->inquilinos as $inquilino)   {
            $inquilinos[$inquilino->id] = $inquilino->getFullName();
        };   
        $gastos_inquilino = $cobro->gastos_liquidados()->where('imputado', 1)->where(function ($query) {$query->where('encargado', 'I')->orWhere('pagado_por', 'I');})->get();
        $totalGastoInq = $this->carcularTotalGastosInquilino($gastos_inquilino);
        
        // Propietarios
        $propietarios = array();
        $namePropietarios = array();
        foreach ($cobro->contrato->propietarios as  $propietario)   {
            $namePropietarios[$propietario->id] = $propietario->getFullName();
            $propietarios[$propietario->id]['nombre'] = $propietario->getFullName();
            $propietarios[$propietario->id]['porcentaje'] = $propietario->pivot->porcentaje;
        };
        $gastos_propietarios = $cobro->gastos_liquidados()->where('imputado', 1)->where(function ($query) {$query->where('encargado', 'P')->orWhere('pagado_por', 'P');})->get();
        $totalGastoPro = $this->carcularTotalGastosPropietario($gastos_propietarios);
        
        $impuestos_entregados = $cobro->impuestos_entregados;
        
        $cheques = $cobro->cheques;
        
        $transferencias = $cobro->transferencias;
        
        return view('gestiones.form')
                ->with('cobro',$cobro)
                ->with('inquilinos',$inquilinos)
                ->with('propietarios',$propietarios)
                ->with('namePropietarios',$namePropietarios)
                ->with('gastos_liquidados',$gastos_liquidados)
                ->with('impuestos_entregados',$impuestos_entregados)
                ->with('cheques',$cheques)
                ->with('transferencias',$transferencias)
                ->with('totalGastoInq',$totalGastoInq)
                ->with('totalGastoPro',$totalGastoPro)
                ->with('periodo',$periodo);
    }

    public function getValores(Request $request){
        $data = array();
        $cobro = Cobro::find($request->cobro_id);
       	$data = $cobro->getValues($request);
        return response()->json($data);
    }

    public function setValores(Request $request){
        $cobro = Cobro::find($request->cobro_id);
       
        // Si esta liquidado lo devuelvo para que pueda generar recibo
        if($cobro->liquidado) {
            $request['id'] = $cobro->id;    
            return $this->generarRecibo($request);
        }
        
        // Seteo valores
        $cobro->fill($request->all());
        
        /*  MANEJO DE IMPUESTOS */
        $cobro->impuestos_entregados()->sync($request->impuestos_entregados);
        if($request->impuestos_entregados){
            $this->setImpuestosEntregados($request->impuestos_entregados);
        }
        
        /*  MANEJO DE GASTOS */
        $cobro->gastos_liquidados()->sync($request->gastos_liquidados);
        if($request->gastos_liquidados){
           $this->setGastosLiquidados($request->gastos_liquidados,$request->gastos_imputados,$request->gastos_visualizados);
        }
        
        /*  MANEJO DE Cheques */
        $cobro->cheques()->sync($request->cheques);
        $monto_cheque = $this->calcularTotalCheques($cobro->cheques);
        
        /*  MANEJO DE Transferencias */
        $cobro->transferencias()->sync($request->transferencias);
        $monto_transferencia = $this->calcularTotalTransferencias($cobro->transferencias);
        
        /*
        ** INICIO PAGO A CUENTA
        **/
        // Si es menor le creo un nuevo registro de cobro
        if($cobro->monto_pagado < $cobro->monto_total){
            $deuda = new Cobro();
            $deuda->contrato_id = $cobro->contrato_id;
            $deuda->mes = $cobro->mes;
            $deuda->ano = $cobro->ano;
            $deuda->monto = $cobro->monto_total - $cobro->monto_pagado;
            $deuda->is_deuda = 1;
            $deuda->save();
        }else{ // Si es mayor le creo un gasto para el periodo siguiente
            //................
        }
        /*
        ** FIN PAGO A CUENTA
        **/
        /*
        ** INICIO MOVIMIENTO A CAJA
        **/
        if($this->user->caja_id)
            $caja = $this->user->caja_id;
        else
            $caja = $cobro->contrato->caja_id;

        // Total de efectivo
        $montoEfectivo = $cobro->monto_pagado - $monto_transferencia- $monto_cheque;
        if ($cobro->honorarios) {
            $montoEfectivo -= $cobro->honorarios;
        }
        $this->createMovimientoCobro($cobro, $montoEfectivo, $caja);
        $this->createMovimientoHonorarios($cobro, $caja);
        /*
        ** FIN MOVIMIENTO A CAJA
        **/

        // Hash para imprimir el recibo desde link publico
        if (!$cobro->hash) {
            $cobro->hash = md5($cobro->id . $cobro->mes . $cobro->ano);
        }

        // Notificacion
        $this->addNotificacion('Se realizó un cobro de contrato', 'http://app.hornero.com/gestiones/', $cobro->contrato_id, $cobro->inquilino_id);
        
        // Lo marco como liquidado y lo guardo
        $cobro->liquidado = 1;
        $cobro->save();

        /*
        ** INICIO ENVIO DE MAIL
        **/
        if($request->mail_inquilino) {
            $input = [
                'message' => 'Le enviamos una copia del recibo correspondiente al periodo ' . $cobro->mes . '/' . $cobro->ano . ' del alquiler del inmueble situado en ' . $cobro->contrato->inmueble->direccion . '.',
                'company' => auth()->user()->sucursal->razon_social,
                'link' => route('download-renter-receipt', $cobro->hash)
            ];
            foreach($cobro->contrato->inquilinos()->get() as $inquilino) {
                if ($inquilino->email) {
                    Mail::to($inquilino->email)->send(new ReceiptMail('[' . auth()->user()->sucursal->razon_social . '] Recibo', $input));
                }
            }
        }
        /*
        ** FIN ENVIO DE MAIL
        **/

        /*
        ** INICIO ENVIO DE PUSH A INQUILINO
        **/

        /*
        ** INICIO ENVIO DE PUSH A INQUILINO
        **/

        /*
        ** INICIO ENVIO DE MAIL A PROPIETARIO
        **/
        if($request->mail_propietario) {
            $input = [
                'message' => 'Le informamos que ya puede pasar por nuestras oficinas a cobrar el pago correspondiente al periodo ' . $cobro->mes . '/' . $cobro->ano . ' del alquiler del inmueble situado en ' . $cobro->contrato->inmueble->direccion . '.',
                'company' => auth()->user()->sucursal->razon_social,
            ];
            foreach($cobro->contrato->propietarios()->get() as $propietario) {
                if ($propietario->email) {
                    Mail::to($propietario->email)->send(new GeneralMail('[' . auth()->user()->sucursal->razon_social . '] Ya puede pasar a cobrar', $input));
                }
            }
        }
        /*
        ** FIN ENVIO DE MAIL A PROPIETARIO
        **/

        /*
        ** INICIO ENVIO DE PUSH A PROPIETARIO
        **/

        /*
        ** FIN ENVIO DE PUSH A PROPIETARIO
        **/

         /*
        ** INICIO ENVIO DE MENSAJE DE TEXTO A PROPIETARIO
        **/
        // Plivo::send_message([
        //     'src' => $user->celular,
        //     'dst' => $propietario->cod_pais.$propietario->celular,
        //     'text' => $plantilla->envio_aviso_pago,
        // ]);
        /*
        ** FIN ENVIO DE MENSAJE DE TEXTO A PROPIETARIO
        **/

        $request['id'] = $cobro->id;
        return $this->generarRecibo($request);
    }

    public function generarRecibo(Request $request){
        $cobro = Cobro::with('empresa', 'sucursal', 'contrato', 'inquilino', 'impuestos_entregados', 'transferencias', 'cheques')->find($request->id);
        
        // Si no tiene inquilino asociado porque lo liquido indirectamente traigo el primer inquilino del contrato //
        if (!$cobro->inquilino) {
            $cobro->inquilino = $cobro->contrato->inquilinos()->first();
        }
        
        // Totales de gastos
        $cobro->gastos_liquidados = $cobro->gastos_liquidados()->where('visualizado', 1)->where(function ($query) {$query->where('encargado', 'I')->orWhere('pagado_por', 'I');})->get();
        $cobro->total_gastos = $this->carcularTotalGastosInquilino($cobro->gastos_liquidados);
        
        // Totales de transferencias
        $cobro->total_transferencia = $this->calcularTotalTransferencias($cobro->transferencias);
        
        // Totales de cheque
        $cobro->total_cheque = $this->calcularTotalCheques($cobro->cheques);
        
        // Hago chequeo de tope por si es pagare
        if($cobro->monto_tope){
            $cobro->monto_pagado = $cobro->monto_tope;
            $cobro->monto = $cobro->monto_tope;
            $cobro->monto_deuda = $cobro->monto_tope - $cobro->monto_deuda;
        }

        $cobro->total_efectivo = $cobro->monto_pagado - $cobro->total_transferencia - $cobro->total_cheque;
        $cobro->monto_letras = NumeroALetras::convertir($cobro->monto_pagado, $cobro->contrato->moneda->nombre, 'centavos');
        $cobro->periodo = $cobro->periodo_desc;

        $pdf = PDF::loadView('gestiones.report.recibo',['cobro'=>$cobro]);
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        if (!Storage::exists($cobro->receipt_path)) {
            $content = $pdf->download()->getOriginalContent();
            Storage::put($cobro->receipt_path, $content);
        }

        return response()->json($cobro);
    }

    public function downloadRenterReceipt(Cobro $cobro) {
        return Storage::download($cobro->receipt_path, 'Recibo de cobro alquiler de contrato carpeta: ' . $cobro->contrato->carpeta . ' - Periodo:' . $cobro->periodo . '.pdf');
    }

    public function liquidarPropietario(Request $request){
        $contrato =  Contrato::find($request->contrato_id);

        /*
        ** CHEQUEO QUE ESTEN CARGADOS CORRECTAMENTE LOS PORCENTAJES
        **/
        $porcentaje = 0;
        foreach ($contrato->propietarios as $propietario) {
            $porcentaje += $propietario->pivot->porcentaje;
        }

        if ($porcentaje != 100) {
            return response()->json(array('error' => 1, 'texto' => 'La suma de los porcentajes es diferente a 100%, no se puede generar liquidacion.'));
        }
        /*
        ** FIN PORCENTAJES
        **/
        /*
        ** CHEQUEO QUE SE ENCUENTRE LIQUIDADO
        **/
        $cobro = Cobro::find($request->cobro_id);
        if (!$cobro->liquidado) {
            return response()->json(array('error' => 1, 'texto' => 'Debe liquidar al inquilino para poder liquidar a los propietarios.'));
        }

        $propietario = $contrato->propietarios()->where('persona_id', $request->propietario_id)->first();

        // Si ya se liquidó devuelvo el pago para que pueda descargar liquidacion
        $pago = Pago::wherePropietarioId($propietario->id)->whereCobroId($cobro->id)->first();
        if ($pago) {
            return response()->json($pago);
        }

        $pago = new Pago;
        $pago->cobro_id = $cobro->id;
        $pago->fecha = date('Y-m-d');
        $pago->propietario_id = $request->propietario_id;
        $pago->monto = $cobro->monto_pagar * $propietario->pivot->porcentaje / 100;

        /*
        ** INICIO MOVIMIENTO A CAJA
        **/
        if($this->user->caja_id) {
            $caja = $this->user->caja_id;
        } else {
            $caja = $cobro->contrato->caja_id;
        }
        $this->createMovimientoPago($cobro, $pago, $caja);
        /*
        ** FIN MOVIMIENTO A CAJA
        **/

        // Hash para poder descargar recibo desde link publico
        if (!$pago->hash) {
            $pago->hash = md5($pago->id . $pago->cobro_id . $pago->propietario_id);
        }

        $pago->save();

        /*
        ** INICIO ENVIO DE MAIL
        **/
        if($request->mail_propietario && $propietario->email) {
            $input = [
                'message' => 'Le enviamos una copia del recibo correspondiente al periodo ' . $cobro->mes . '/' . $cobro->ano . ' del alquiler del inmueble situado en ' . $cobro->contrato->inmueble->direccion . '.',
                'company' => auth()->user()->sucursal->razon_social,
                'link' => route('download-owner-receipt', $pago->hash)
            ];
            Mail::to($propietario->email)->send(new ReceiptMail('[' . auth()->user()->sucursal->razon_social . '] Recibo', $input));
        }
        /*
        ** FIN ENVIO DE MAIL
        **/
        /*
        ** INICIO ENVIO DE PUSH A PROPIETARIO
        **/
        /*
        ** FIN ENVIO DE PUSH A PROPIETARIO
        **/

        $request['id'] = $pago->id;
        return $this->generarLiquidacion($request);
    }

    public function generarLiquidacion(Request $request){
        $pago = Pago::find($request->id);
        $cobro = Cobro::with('empresa', 'sucursal', 'contrato', 'impuestos_entregados')->find($pago->cobro_id);
        $cobro->propietario;
        // Totales de gastos
        $pago->gastos_liquidados = $cobro->gastos_liquidados()->where('visualizado', 1)->where(function ($query) {$query->where('encargado', 'P')->orWhere('pagado_por', 'P');})->get();
        $pago->total_gastos = $this->carcularTotalGastosPropietario($cobro->gastos_liquidados);

        $pago->monto_letras = NumeroALetras::convertir($pago->monto, $cobro->contrato->moneda->nombre, 'centavos');
        $cobro->periodo = $cobro->periodo_desc;
        $pdf = PDF::loadView('gestiones.report.liquidacion',['cobro'=>$cobro,'pago'=>$pago]);
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        if (!Storage::exists($pago->receipt_path)) {
            $content = $pdf->download()->getOriginalContent();
            Storage::put($pago->receipt_path, $content) ;
        }

        return response()->json($pago);
    }

    public function downloadOwnerReceipt(Pago $pago) {
        return Storage::download($pago->receipt_path, 'Liquidacion a propietario ' . $pago->propietario->getFullName() . ' ,alquiler de contrato carpeta: ' . $pago->cobro->contrato->carpeta . ' - Periodo:' . $pago->cobro->periodo . '.pdf');
    }

    // public function downloadOwnerInvoice(Factura $invoice) {
    //     return Storage::download($invoice->invoice_path, 'Factura a propietario ' . $invoice->propietario->getFullName() . ' ,alquiler de contrato carpeta: ' . $invoice->cobro->contrato->carpeta . ' - Periodo:' . $invoice->cobro->periodo . '.pdf');
    // }

    public function generateOwnerAfipInvoice(Request $request){
        $contrato =  Contrato::find($request->contrato_id);

        // Chequeo si se generó anteriormente
        $afipInvoice = AfipInvoice::whereCobroId($request->cobro_id)->wherePersonaId($request->propietario_id)->first();
        if ($afipInvoice) {
            return response()->json($afipInvoice);
        }
        /*
        ** Chequeo la credencial
        **/
        if (!$request->credencial_id) {
            return response()->json(array('error' => 1, 'texto' => 'Debe seleccionar una credencial válida.'));
        }

        /*
        ** Chequeo que se haya liquidado y exista valor a liquidar
        **/
        $cobro = Cobro::find($request->cobro_id);
        if (!$cobro->liquidado) {
            return response()->json(array('error' => 1, 'texto' => 'Debe liquidar al inquilino para poder liquidar a los propietarios.'));
        }

        if ($cobro->honorarios <= 0) {
            return response()->json(array('error' => 1, 'texto' => 'El contrato no tiene honorarios cargados.'));
        }

        /*
        ** Chequeo los porcentajes de propietarios
        **/
        $porcentaje = 0;
        foreach ($contrato->propietarios as $propietario) {
            $porcentaje += $propietario->pivot->porcentaje;
        }
        if ($porcentaje != 100) {
            return response()->json(array('error' => 1, 'texto' => 'La suma de los porcentajes es diferente a 100%, no se puede generar liquidacion.'));
        }

        /*
        ** Chequeo que tenga datos de facturacion
        **/
        $propietario = $contrato->propietarios()->where('persona_id', $request->propietario_id)->first();

        if (!$propietario->nro_documento || !$propietario->tipo_documento_id || !$propietario->nro_cui || !$propietario->tipo_iva_id) {
            return response()->json(array('error' => 1, 'texto' => 'El propietario debe tener cargados datos de facturación.'));
        }

        // Genero la factura de AFIP
        $invoiceRepository = new InvoiceRepository($propietario, $cobro, \App\AfipCredential::find($request->credencial_id));


        $cae = $invoiceRepository->generateAfipInvoice();

        // Comienzo Transacción
        $afipInvoice = new AfipInvoice;
        $afipInvoice->cobro_id = $cobro->id;
        $afipInvoice->persona_id = $request->propietario_id;
        $afipInvoice->date = date('Y-m-d');
        $afipInvoice->amount = $cobro->honorarios * $propietario->pivot->porcentaje / 100;
        $afipInvoice->afip_credential_id = $request->credencial_id;

        // Datos de factura AFIP
        $afipInvoice->invoice_number = rand(0, 999999);
        $afipInvoice->cae = $cae['CAE'];
        $afipInvoice->cae_expiration = $cae['CAEFchVto'];

        // Hash para poder descargar recibo desde link publico
        $afipInvoice->hash = md5($afipInvoice->cobro_id . $afipInvoice->persona_id);
        $afipInvoice->save();


        $pdf = $invoiceRepository->generateAfipInvoicePDF($cae);

        if (!Storage::exists($afipInvoice->invoice_path)) {
            $content = $pdf->download()->getOriginalContent();
            Storage::put($afipInvoice->invoice_path, $content);
        }


        if($request->mail_propietario && $afipInvoice->persona->email) {
            $input = [
                'message' => 'Le enviamos su factura correspondiente al periodo ' . $cobro->mes . '/' . $cobro->ano . ' del alquiler del inmueble situado en ' . $cobro->contrato->inmueble->direccion . '.',
                'company' => auth()->user()->sucursal->razon_social,
                'link' => route('download-owner-invoice', $afipInvoice->hash)
            ];
            Mail::to($afipInvoice->persona->email)->send(new ReceiptMail('[' . auth()->user()->sucursal->razon_social . '] Factura', $input));
        }

        return response()->json($afipInvoice);
    }

    public function downloadOwnerAfipInvoice(AfipInvoice $afipInvoice) {
        return Storage::download($afipInvoice->invoice_path, 'Factura electrónica a propietario ' . $afipInvoice->persona->getFullName() . ' ,alquiler de contrato carpeta: ' . $afipInvoice->cobro->contrato->carpeta . ' - Periodo:' . $afipInvoice->cobro->periodo . '.pdf');
    }

    public function setLiquidatedFromContract(Request $request)
    {
        $cobro = Cobro::find($request->id);
        $cobro->liquidado = 1;
        $cobro->propietarios_liquidados = 1;
        $cobro->monto_total = $cobro->monto;
        $cobro->monto_pagado = $cobro->monto;

        if (!$cobro->hash) {
            $cobro->hash = md5($cobro->id . $cobro->mes . $cobro->ano);
        }

        $cobro->save();

        return response()->json($cobro);
    }
    
    private function carcularTotalGastosInquilino($gastos){
        $totalGasto = 0;
        if($gastos){
            foreach ($gastos as $gasto) {
                if($gasto->encargado == 'I')
                    $totalGasto += $gasto->monto;
                else
                    $totalGasto -= $gasto->monto;
            }
        }
        return $totalGasto;
    }
    private function carcularTotalGastosPropietario($gastos){
        $totalGasto = 0;
        if($gastos){
            foreach ($gastos as $gasto) {
                if($gasto->encargado == 'P')
                    $totalGasto -= $gasto->monto;
                else
                    $totalGasto += $gasto->monto;
            }
        }
        return $totalGasto;
    }
    private function calcularTotalCheques($cheques){
        $totalCheque = 0;
        if($cheques){
            foreach ($cheques as $cheque) {
                $totalCheque+= $cheque->monto;
            }
        }
        return $totalCheque;
    }
    private function calcularTotalTransferencias($transferencias){
        $totalTransferencia = 0;
        if($transferencias){
            foreach ($transferencias as $transferencia) {
                $totalTransferencia+= $transferencia->monto;
            }
        }
        return $totalTransferencia;
    }
    private function setGastosLiquidados($gastos, $gastos_imputados, $gastos_visualizados){
        foreach ($gastos as $gasto_liquidado) {
            $gasto = Gasto::find($gasto_liquidado);
            if(in_array($gasto_liquidado, $gastos_imputados))
                $gasto->imputado = 1;
            if(in_array($gasto_liquidado, $gastos_visualizados))
                $gasto->visualizado = 1;
            $gasto->liquidado = 1;
            $gasto->save();
        }
    }
    private function setImpuestosEntregados($impuestos){
        foreach ($impuestos as $impuesto_entregado) {
            $impuesto = Impuesto::find($impuesto_entregado);
            $impuesto->entregado = 1;
            $impuesto->save();
        }
    }
    private function createMovimientoCobro($cobro,$monto,$caja){
        //Genero registro si tiene valor
        if($monto){
            $movimiento = new Movimiento;
            $movimiento->caja_id = $caja;
            $movimiento->cuenta_id = $cobro->contrato->cuenta_ingreso_id;
            $movimiento->fecha = date('Y-m-d');
            $movimiento->monto = $monto;
            $movimiento->moneda_id = $cobro->contrato->moneda_id;
            $movimiento->save();
            $movimiento->personas()->attach($cobro->inquilino);
            $movimiento->contratos()->attach($cobro->contrato_id);
            $movimiento->cobros()->attach($cobro->id);
        }
    }
    private function createMovimientoHonorarios($cobro,$caja){
        //Genero registro si tiene valor
        if($cobro->honorarios){
            $movimiento = new Movimiento;
            $movimiento->caja_id = $caja;
            $movimiento->cuenta_id = $cobro->contrato->cuenta_honorarios_id;
            $movimiento->fecha = date('Y-m-d');
            $movimiento->monto = $cobro->honorarios;
            $movimiento->moneda_id = $cobro->contrato->moneda_id;
            $movimiento->save();
            $movimiento->contratos()->attach($cobro->contrato_id);
            $movimiento->cobros()->attach($cobro->id);
        }
    }
    private function createMovimientoPago($cobro,$pago,$caja){
        //Genero registro si tiene valor
        if($pago->monto){
            $movimiento = new Movimiento;
            $movimiento->caja_id = $caja;
            $movimiento->cuenta_id = $cobro->contrato->cuenta_egreso_id;
            $movimiento->fecha = date('Y-m-d');
            $movimiento->monto = $pago->monto;
            $movimiento->moneda_id = $cobro->contrato->moneda_id;
            $movimiento->save();
            $movimiento->personas()->attach($pago->propietario_id);
            $movimiento->contratos()->attach($cobro->contrato_id);
            $movimiento->cobros()->attach($cobro->id);
        }
    }
    /*
    **
    ** TRAE COBROS LIQUIDADOS PARA EL LISTADO DE GESTIONES
    **
    */
    public function getCobros(Request $request){
        $contrato = Contrato::find($request->contrato_id);
        $cobros = $contrato->cobros->where('liquidado',1);
        return $cobros->toJson();
    }

    /*
    ** MODIFICA PORCENTAJE DE COORS DE PROPIETARIOS
    */
    public function modificarPorcentaje(Request $request){
        $error = 0;
        if($request->porcentaje>100)
            $error = 1;
        else
            $propietario = DB::table('contrato_propietario')
                ->where('contrato_id', $request->contrato_id)
                ->where('persona_id', $request->propietario_id)
                ->update(['porcentaje' => $request->porcentaje]);
        echo json_encode($error);
    }

    function getRenterReceiptFromStorage(String $hash) {
        $cobro = \App\Cobro::whereHash($hash)->first();
        \App\HashLog::generate('App\Cobro', $cobro->id);

        if (Storage::exists($cobro->receipt_path)) {
            return Storage::download($cobro->receipt_path, 'recibo.pdf');
        }
    }

    function getOwnerReceiptFromStorage(String $hash) {
        $pago = \App\Pago::whereHash($hash)->first();

        \App\HashLog::generate('App\Pago', $pago->id);

        if (Storage::exists($pago->receipt_path)) {
            return Storage::download($pago->receipt_path, 'recibo.pdf');
        }
	}
	
    function getOwnerInvoiceFromStorage(String $hash) {
        $afipInvoice = \App\AfipInvoice::whereHash($hash)->first();

        \App\HashLog::generate('App\AfipInvoice', $afipInvoice->id);
        if (Storage::exists($afipInvoice->invoice_path)) {
            return Storage::download($afipInvoice->invoice_path, 'factura.pdf');
        }
    }
}
