<?php

namespace App\Http\Controllers;

use App\Cheque;
use App\Banco;
use App\Movimiento;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ChequeController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cheques.list');
    }
    /**
     * Lista registros de la base de datos 
     *
     * @return json data 
     */
    public function datatable()
    {
        $model = Cheque::with('banco')->with('cobros')->get();
        return Datatables::of($model)
            ->addColumn('accion', function ($row) {
                $acciones = ($row->cobrado)?'<span class="m-badge m-badge--success m-badge--wide">Cobrado</span>':'<button class="btn btn-success m-tooltip" onclick="setCobrado('.$row->id.')" title="Marcar como cobrado"><i class="la la-check"></i></button>';
                $acciones.=($row->imputado)?'<span class="m-badge m-badge--success m-badge--wide">Imputado</span>':'<button class="btn btn-danger m-tooltip" onclick="setImputado('.$row->id.')" title="Imputar a caja"><i class="la la-dollar"></i></button>';
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
        $cheque = new Cheque($request->all());
        $cheque->save();
        $cheque->banco;
        return response()->json($cheque);
    }
    /**
     * FUNCION PARA MARCAR EL CHEQUE COMO COBRADO
     *
     */
    public function setCobrado(Request $request)
    {
        $cheque = Cheque::find($request->cheque_id);
        $cheque->cobrado = 1; 
        $cheque->save();

        return response()->json($cheque);
    }
    /**
     * FUNCION PARA MARCAR EL CHEQUE COMO IMPUTADO Y GENERAR EL MOVIMIENTO EN LA CAJA
     *
     */
    public function setImputado(Request $request)
    {
        $cheque = Cheque::find($request->cheque_id);
        //Genero el movimiento en la caja
        $this->createMovimientoCheque($cheque);
        $cheque->imputado = 1; 
        $cheque->save();

        return response()->json($cheque);
    }
    
    // Genera movimiento  en caja
    private function createMovimientoCheque($cheque){
        $cobro = $cheque->cobros()->first();
        if($this->user->caja_id){
            $caja = $this->user->caja_id;
        }
        else{
            $caja = $cobro->contrato->caja_id;
        }
        //Genero registro si tiene valor
        if($cheque->monto){
            $movimiento = new Movimiento;
            $movimiento->caja_id = $caja;
            $movimiento->cuenta_id = $cobro->contrato->cuenta_ingreso_id;
            $movimiento->fecha = date('Y-m-d');
            $movimiento->monto = $cheque->monto;
            $movimiento->moneda_id = $cobro->contrato->moneda_id;
            $movimiento->save();
            $movimiento->contratos()->attach($cobro->contrato_id);
            $movimiento->cobros()->attach($cobro->id);
        }
    }
}
