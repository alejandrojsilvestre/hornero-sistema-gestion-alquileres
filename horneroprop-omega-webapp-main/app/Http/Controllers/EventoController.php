<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Motivo;
use Illuminate\Http\Request;
use Auth;

class EventoController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motivos = Motivo::orderBy('nombre', 'ASC')->get();
        return view('eventos.list');
    }

    public function calendar(Request $request)
    {
        $eventos = Auth::user()->eventos()->where('inicio', '>=', ($request->start))->where('fin', '<=', $request->end)->get();

        $json=array();

        foreach ($eventos as $evento) {
            $jsonParcial['title']= $evento->titulo;
            $jsonParcial['id']=$evento->id;
            $jsonParcial['description']=$evento->getNotas();
            $jsonParcial['start']=date("Y-m-d\TH:i:s", strtotime($evento->inicio));
            $jsonParcial['end']=date("Y-m-d\TH:i:s", strtotime($evento->fin));
            $jsonParcial['color']=$evento->motivo->color;
            $json[]=$jsonParcial;
        }
        echo json_encode($json);
    }

    public function search(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $results = Provincia::where('nombre', 'LIKE', '%'.$term.'%')->limit(10)->get();

        $formatted_result = [];

        foreach ($results as $result) {
            $formatted_result[] = ['id' => $result->nombre, 'text' => $result->nombre];
        }

        return \Response::json($formatted_result);
    }

    /**
     * Store a newly created resource in storage.
     *
     *§ @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Ingreso registro via ajax */
        $evento = new Evento($request->all());
        $evento->created_by()->associate(Auth::user()->id);
        $evento->save();

        $evento->personas()->sync($request->personas);
        $evento->inmuebles()->sync($request->inmuebles);
        $evento->users()->sync($request->users);

        return response()->json($evento);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evento = Evento::with('personas', 'inmuebles', 'users')->find($id);
        foreach ($evento->users as $user) {
            $evento->users[] = $user->id;
        }
        return response()->json($evento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /* Ingreso registro via ajax */
        $evento = Evento::find($id);
        $evento->fill($request->all());
        $evento->save();

        $evento->personas()->sync($request->personas);
        $evento->inmuebles()->sync($request->inmuebles);
        $evento->users()->sync($request->users);

        return response()->json($evento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evento = Evento::find($id); 
        $evento->delete();

        return response()->json($evento->delete());
    }
}
