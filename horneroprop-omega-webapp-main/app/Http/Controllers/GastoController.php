<?php

namespace App\Http\Controllers;

use App\Gasto;
use App\Concepto;
use App\Contrato;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class GastoController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gastos.list');
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
        $gasto = new Gasto($request->all());
        /* Si no trae concepto ni nuevo concepto devuelvo error
           Sino creo nuevo concepto
        */
        if(!$request->concepto_id && !$request->concepto){
            return false;
        }elseif(!$request->concepto_id && $request->concepto){
            $concepto = Concepto::create(['nombre' => $request->concepto]);
            $gasto->concepto_id = $concepto->id;
        }
        $gasto->save();
        return response()->json($gasto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gasto = Gasto::find($id);
        return response()->json($gasto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gasto = Gasto::find($id); 
        //Si es un gasto liquidado no se modifica.
        if($gasto->liquidado)
            return $gasto->toJson();
        $gasto->fill($request->all());
        $gasto->save();
        return response()->json($gasto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Si es un gasto liquidado no se elimina.
        $gasto = Gasto::find($id); 
        if($gasto->liquidado) {
            return response()->json($gasto);
        }
        
        return response()->json($gasto->delete());
    }
    /*
    **
    ** TRAE LOS GASTOS DE UN CONTRATO
    **
    */
    public function getGastosByContrato(Request $request){
        $contrato = Contrato::find($request->contrato_id);
        // Realizo chequeo de rotacion
        $gastos = $contrato->gastos()->with('concepto')->with('cobro')->where('rota',1)->where(function ($query) {$query->where('last_check','!=',date('Y-m-d'))->orWhereNull('last_check');})->get();
        foreach ($gastos as $gasto) {
            $this->checkRotacion($gasto);
            // Seteo ultimo chequeo con la fecha de hoy
            $gasto->last_check = date('Y-m-d');
            $gasto->save();
        }
        $gastosByContrato = $contrato->gastos()->with('concepto')->with('cobro');
        if($request->estado)
            $gastosByContrato = $gastosByContrato->where('liquidado',0);
        $gastosByContrato = $gastosByContrato->get()->toJson();
        return $gastosByContrato;
    }
    /*
    **
    ** PROCESO DE GENERACION DE GASTOS ROTATIVOS
    **
    */
    public function checkRotacion($gasto){
        $cobro = $gasto->cobro;
        $fechaActual = date('Y-m-d');;
        $fechaGasto = date('Y-m-d', strtotime($cobro->ano.'-'.$cobro->mes.'-01' . ' +' . $gasto->cada . ' months'));
        // Desde el periodo del gasto hasta el actual chequeo que se haya creado 
        while (strtotime($fechaActual)>=strtotime($fechaGasto)):
            // Traigo periodo
            $getCobro = \App\Cobro::where('mes',date('m',strtotime($fechaGasto)))->where('ano',date('Y',strtotime($fechaGasto)))->where('contrato_id',$gasto->contrato_id)->first();
            //Si no esta creado lo genero
            if($getCobro->gastos()->where('concepto_id',$gasto->concepto_id)->where('contrato_id',$gasto->contrato_id)->count() == 0){
                $gasto = new Gasto($gasto->toArray());
                $gasto->id = null;
                $gasto->cobro_id = $getCobro->id;
                $gasto->rota = 0;
                $gasto->save();
            }
            $fechaGasto = date('Y-m-d', strtotime($fechaGasto . ' +' . $gasto->cada . ' months'));
        endwhile;

    }
}
