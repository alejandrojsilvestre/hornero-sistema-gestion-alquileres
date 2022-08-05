<?php

namespace App;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Cobro extends SisModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cobros';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['inquilino_id','monto','mes','ano','fecha','monto_pagado','monto_total','monto_deuda','monto_tope','monto_pagar','punitorio','honorarios','is_deuda','liquidado','notas'];
    
    protected $appends = ['periodo_desc'];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * Traer empresa
     */ 
    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }
    /**
     * Traer sucursal
     */ 
    public function sucursal()
    {
        return $this->belongsTo('App\Sucursal');
    }
    /**
     * Traer inmueble
     */ 
    public function contrato()
    {
        return $this->belongsTo('App\Contrato');
    }
    /**
     * Traer inquilino
     */ 
    public function inquilino()
    {
        return $this->belongsTo('App\Persona');
    }
    /**
     * Traer Pagos
     */ 
    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }  
    /**
     * Traer Gastos
     */ 
    public function gastos()
    {
        return $this->hasMany('App\Gasto');
    }
    /**
     * Traer Impuestos
     */ 
    public function impuestos()
    {
        return $this->hasMany('App\Impuesto');
    }
    /**
     * Traer Impuestos
     */ 
    public function cheques()
    {
        return $this->belongsToMany('App\Cheque','cobro_cheque')->withTimeStamps()->using('App\CobroCheque');
    }
    /**
     * Traer Impuestos
     */ 
    public function transferencias()
    {
        return $this->belongsToMany('App\Transferencia','cobro_transferencia')->withTimeStamps()->using('App\CobroTransferencia');
    }
    /**
     * Traer impuestos_entregados
     */ 
    public function impuestos_entregados()
    {
        return $this->belongsToMany('App\Impuesto','cobro_impuesto')->withTimeStamps()->using('App\CobroImpuesto');
    }
    /**
     * Traer Impuestos
     */ 
    public function gastos_liquidados()
    {
        return $this->belongsToMany('App\Gasto','cobro_gasto')->withTimeStamps()->using('App\CobroGasto');
    }
    /* 
    ** Mutator para parsear periodo
    */
    public function getPeriodoDescAttribute()
    {
        return $this->meses[$this->mes] . ' - ' . $this->ano;
    }
    /* 
    ** Mutator para parsear fecha
    */
    public function getFechaAttribute($value)
    {
        return ($value!='1970-01-01' && $value!=null)?date('d-m-Y',strtotime($value)):'';
    }
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = date('Y-m-d',strtotime($value));
    }

    public function getReceiptPathAttribute() {
        return 'contratos/' . $this->contrato->id . '/cobros/' . $this->id . '/receipt.pdf';
    }
    /* 
    ** 
    ** FUNCION PARA CALCULAR VALORES DEL PERIODO, DEVUELVE ARRAY CON MONTOS
    **
    */
    public function getValues($request=null)
    {
        $contrato = $this->contrato;
        /*
        **
        ** INICIO CALCULO PUNITORIOS
        **
        **/
        //CHEQUEO QUE EL CONTRATO TENGA TODOS LOS DATOS PARA CARLCULAR
        if($contrato->interes_vencimiento && $contrato->interes_inicio && ($contrato->interes_fijo || $contrato->interes))
        {
            $fecha = ($request->fecha) ? date('Y-m-d',strtotime($request->fecha)) : date('Y-m-d');
            $fecha = new DateTime($fecha);
            if($contrato->punitorios_habil){
                // ULTIMO DIA HABIL HACER DE VARIABLE DE SISTEMA
                $ultimoDiaHabil = 0;
                $dayOfWeek = $fecha->format('w');
                if ($dayOfWeek == $ultimoDiaHabil) 
                {
                    $diaVencimiento = $contrato->interes_vencimiento + 1;
                }else{
                    $diaVencimiento = $contrato->interes_vencimiento;
                }
            }else{
                $diaVencimiento = $contrato->interes_vencimiento;
            }
            $interesDesde = $contrato->interes_inicio;
            $fechaVencimiento = new DateTime($this->ano.'-'.$this->mes.'-'.$diaVencimiento); 
            $fechaInteres = new DateTime($this->ano.'-'.$this->mes.'-'.$interesDesde); 

            if ($fecha < $fechaVencimiento)
            {
                $punitorio = 0;
            }
            else
            {
                $diff = $fecha->diff($fechaVencimiento); 
                $diasDePunitorio = (int)$diff->format('%d'); 
                if ($contrato->interes_acumulativo)
                {
                    $valorAcumulado = $this->monto;
                    $valorTotal = 0;
                    for ($i = 0; $i < $diasDePunitorio; $i++)
                    {
                        if(!empty($contrato->interes_fijo)){
                            $valorFijo = $contrato->interes_fijo;
                            $valorTotal = $valorTotal + $valorFijo;
                        }else{
                            $valorSuma = $valorAcumulado * $contrato->interes / 100;
                            $valorAcumulado = $valorAcumulado + $valorSuma;
                            $valorTotal = $valorTotal + $valorSuma;
                        }
                    }
                    $punitorio = $valorTotal;
                }
                else
                {
                    if(!empty($contrato->interes_fijo))
                        $punitorio = $diasDePunitorio * $contrato->interes_fijo;
                    else
                        $punitorio = $diasDePunitorio * ($this->monto * $contrato->interes / 100);
                }
            }
            if($contrato->imputa_iva_punitorios)
                $punitorio = $punitorio * 1.21;

            if($request->punitorio){
                if($request->punitorio=='noCobra')
                    $punitorio = 0;
                else
                    $punitorio = $request->punitorio;
            }
        }else{
            $punitorio = 0;
        }
        $data['valores']['punitorio'] = $punitorio;
        /*
        **
        ** FIN CALCULO PUNITORIOS
        **
        **/
        /*
        **
        ** INICIO CALCULO COBRO AL INQUILINO
        **
        **/
        $montoTotal = $this->monto;
        if($contrato->imputa_iva)
            $montoTotal = $montoTotal * 1.21;

        $montoTotal += $punitorio;
        // Gastos
        if($request->gastos_imputados){
            $gastos = $contrato->gastos()
                                ->where(function ($query) {$query->where('encargado', 'I')->orWhere('pagado_por', 'I');})
                                ->whereIn('id', $request->gastos_imputados)->get();
            $data['valores']['gastos_inquilinos'] = $this->calcularTotalGastosInquilino($gastos);
        }else{
            $data['valores']['gastos_inquilinos'] = 0;
        }
        $montoTotal+=$data['valores']['gastos_inquilinos'];
        $data['valores']['monto_total'] = $montoTotal;
        if($request->action=='changePagado')
            $data['valores']['monto_pagado'] = $request->monto_pagado;
        else
            $data['valores']['monto_pagado'] = $montoTotal;
        /*
        **
        ** FIN CALCULO COBRO AL INQUILINO
        **
        **/
        /*
        **
        ** INICIO CALCULO PAGO AL PROPIETARIO
        **
        **/
        $montoTotalPago = $this->monto - $request->monto_deuda;
        if(!$contrato->punitorios_administracion)
            $montoTotalPago += $punitorio;
        // Gastos
        if($request->gastos_imputados){
            $gastos = $contrato->gastos()
                                ->where(function ($query) {$query->where('encargado', 'P')->orWhere('pagado_por', 'P');})
                                ->whereIn('id', $request->gastos_imputados)->get();
            $data['valores']['gastos_propietarios'] = $this->calcularTotalGastosPropietario($gastos);
            $montoTotalPago+=$data['valores']['gastos_propietarios'];
        }else{
            $data['valores']['gastos_propietarios'] = 0;
        }
        // Honorarios
        //CHEQUEO QUE EL CONTRATO TENGA TODOS LOS DATOS PARA CALCULAR
        if(($contrato->honorarios || $contrato->honorarios_fijos) && (!$this->is_deuda))
        {
            if($contrato->honorarios_fijos){
                $honorarios = $contrato->honorarios_fijos;
            }else{
                $honorarios = $this->monto;
                if($contrato->honorarios_sobre_punitorios && !$contrato->punitorios_administracion)
                        $honorarios+= $punitorio;
                if($contrato->imputa_iva_honorarios)
                    $honorarios+= $honorarios * 0.21;
                if($contrato->honorarios_sobre_cobrado && $request->monto_pagado){
                    $honorarios = $montoTotalPago * $contrato->honorarios / 100;
                }else{
                    $honorarios = $honorarios * $contrato->honorarios / 100;
                }
            }
        }elseif($this->is_deuda){
            if($contrato->honorarios_sobre_cobrado){
                $honorarios = $montoTotalPago * $contrato->honorarios / 100;
            }else{
                $honorarios = 0;
            }
        }else{
            $honorarios = 0;
        }
        $data['valores']['honorarios'] = $honorarios;
        $data['valores']['monto_pagar'] = $montoTotalPago - $honorarios;
        /*
        **
        ** FIN CALCULO COBRO AL PROPIETARIO
        **
        **/
        $data['valores']['moneda'] = $contrato->moneda->signo;
        $data['valores']['monto'] = $this->monto;
        return $data;
    }
    
    private function calcularTotalGastosInquilino($gastos){
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
    private function calcularTotalGastosPropietario($gastos){
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
}
