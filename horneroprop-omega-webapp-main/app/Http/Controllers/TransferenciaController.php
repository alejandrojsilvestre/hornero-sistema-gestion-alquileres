<?php

namespace App\Http\Controllers;

use App\Transferencia;
use App\Banco;
use App\Movimiento;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TransferenciaController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transferencias.list');
    }

    /**
     * Lista registros de la base de datos 
     *
     * @return json data 
     */
    public function datatable()
    {
        $model = Transferencia::with('banco')->with('cobros')->get();
        return Datatables::of($model)
            ->addColumn('accion', function ($row) {
                $acciones = ($row->confirmada)?'<span class="m-badge m-badge--success m-badge--wide">Confirmada</span>':'<button class="btn btn-success m-tooltip" onclick="setConfirmada('.$row->id.')" title="Marcar como confirmada"><i class="la la-check"></i></button>';
                $acciones.=($row->imputada)?'<span class="m-badge m-badge--success m-badge--wide">Imputada</span>':'<button class="btn btn-danger m-tooltip" onclick="setImputada('.$row->id.')" title="Imputar a caja"><i class="la la-dollar"></i></button>';
                return $acciones; 
            })
            ->addColumn('banco', function ($row) {
                return $row->banco->nombre;
            })
            ->addColumn('cobros', function ($row) {
                return $row->cobros->map(function($cobro) {
                    return '<strong>'.$cobro->contrato->carpeta.'</strong> - '.$cobro->contrato->inmueble->direccion.'<br/><strong>'.$cobro->periodo_desc.'</strong>';
                })->implode('</br>');
            })
            ->rawColumns(['accion','cobros'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Ingreso registro via ajax */
        $transferencia = new Transferencia($request->all());
        $transferencia->save();
        $transferencia->banco;
        return response()->json($transferencia);
    }

    /**
     * FUNCION PARA MARCAR EL TRANSFERENCIA COMO COBRADO
     *
     */
    public function setConfirmada(Request $request)
    {
        $transferencia = Transferencia::find($request->transferencia_id);
        $transferencia->confirmada = 1; 
        $transferencia->save();

        return response()->json($transferencia);
    }
    /**
     * FUNCION PARA MARCAR EL TRANSFERENCIA COMO IMPUTADO Y GENERAR EL MOVIMIENTO EN LA CAJA
     *
     */
    public function setImputada(Request $request)
    {
        $transferencia = Transferencia::find($request->transferencia_id);
        //Genero el movimiento en la caja
        $this->createMovimientoTransferencia($transferencia);
        $transferencia->imputada = 1; 
        $transferencia->save();

        return response()->json($transferencia);
    }
    // Genera movimiento  en caja
    private function createMovimientoTransferencia($transferencia){
        $cobro = $transferencia->cobros()->first();
        if($this->user->caja_id){
            $caja = $this->user->caja_id;
        }
        else{
            $caja = $cobro->contrato->caja_id;
        }
        //Genero registro si tiene valor
        if($transferencia->monto){
            $movimiento = new Movimiento;
            $movimiento->caja_id = $caja;
            $movimiento->cuenta_id = $cobro->contrato->cuenta_ingreso_id;
            $movimiento->fecha = date('Y-m-d');
            $movimiento->monto = $transferencia->monto;
            $movimiento->moneda_id = $cobro->contrato->moneda_id;
            $movimiento->save();
            $movimiento->contratos()->attach($cobro->contrato_id);
            $movimiento->cobros()->attach($cobro->id);
        }
    }
}
