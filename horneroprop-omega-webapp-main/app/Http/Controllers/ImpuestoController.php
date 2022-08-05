<?php

namespace App\Http\Controllers;

use App\Impuesto;
use App\Servicio;
use App\Contrato;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ImpuestoController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $impuesto = new Impuesto($request->all());
        /* Si no trae concepto ni nuevo concepto devuelvo error
           Sino creo nuevo concepto
        */
        if(!$request->servicio_id && !$request->servicio){
            return false;
        }elseif(!$request->servicio_id && $request->servicio){
            $servicio = Servicio::create(['nombre' => $request->servicio]);
            $impuesto->servicio_id = $servicio->id;
        }
        $impuesto->save();
        return response()->json($impuesto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $impuesto = Impuesto::find($id);        
        return response()->json($impuesto);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $impuesto = Impuesto::find($id); 
        //Si es un impuesto entregado no se modifica.
        if($impuesto->entregado)
            return $impuesto->toJson();
        $impuesto->fill($request->all());
        $impuesto->save();  
        return response()->json($impuesto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Si es un impuesto entregado no se elimina.
        $impuesto = Impuesto::find($id); 
        if($impuesto->entregado) {
            return response()->json($impuesto);
        }
        return response()->json($impuesto->delete());
    }
    /*
    **
    ** TRAE LOS GASTOS DE UN CONTRATO
    **
    */
    public function getImpuestosByContrato(Request $request){
        $contrato = Contrato::find($request->contrato_id);
        $impuestos = $contrato->impuestos()->with('servicio')->with('cobro')->where('rota',1)->where(function ($query) {$query->where('last_check','!=',date('Y-m-d'))->orWhereNull('last_check');})->get();
        // Realizo chequeo de rotacion
        foreach ($impuestos as $impuesto) {
            $this->checkRotacion($impuesto);
            // Seteo ultimo chequeo con la fecha de hoy
            $impuesto->last_check = date('Y-m-d');
            $impuesto->save();
        }

        $impuestosByContrato = $contrato->impuestos()->with('servicio')->with('cobro');
        // Chequeo traigo todos o solos los pendientes.
        if($request->estado)
            $impuestosByContrato = $impuestosByContrato->where('entregado',0);
        $impuestosByContrato = $impuestosByContrato->get()->toJson();
        return $impuestosByContrato;
    }
    /*
    **
    ** PROCESO DE GENERACION DE GASTOS ROTATIVOS
    **
    */
    public function checkRotacion($impuesto){
        $cobro = $impuesto->cobro;
        $fechaActual = date('Y-m-d');
        $fechaImpuesto = date('Y-m-d', strtotime($cobro->ano.'-'.$cobro->mes.'-01' . ' +' . $impuesto->cada . ' months'));
        // Desde el periodo del impuesto hasta el actual chequeo que se haya creado 
        while (strtotime($fechaActual)>=strtotime($fechaImpuesto)):
            // Traigo periodo
            $getCobro = \App\Cobro::where('mes',date('m',strtotime($fechaImpuesto)))->where('ano',date('Y',strtotime($fechaImpuesto)))->where('contrato_id',$impuesto->contrato_id)->first();
            //Si no esta creado lo genero
            if($getCobro->impuestos()->where('servicio_id',$impuesto->servicio_id)->where('contrato_id',$impuesto->contrato_id)->count() == 0){
                $impuesto = new Impuesto($impuesto->toArray());
                $impuesto->id = null;
                $impuesto->cobro_id = $getCobro->id;
                $impuesto->rota = 0;
                $impuesto->save();
            }
            $fechaImpuesto = date('Y-m-d', strtotime($fechaImpuesto . ' +' . $impuesto->cada . ' months'));
        endwhile;
    }
}
