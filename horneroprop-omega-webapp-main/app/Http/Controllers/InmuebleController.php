<?php

namespace App\Http\Controllers;

use App\Inmueble;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Repositories\UbicationRepository;

class InmuebleController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inmuebles.list');
    }
    /**
     * Lista registros de la base de datos 
     *
     * @return json data 
     */
    public function datatable(Request $request)
    {
        $model = Inmueble::with('tipo')->get();
        return Datatables::of($model)     
            ->addColumn('accion', function ($row) {
                return '<button class="btn btn-xs btn-primary editProperty" data-remote="'.route('inmuebles.show', $row->id).'">Ver</button>
                    <button class="btn btn-xs btn-danger btn-delete" data-remote="'.route('inmuebles.destroy', $row->id).'"><i class="la la-trash white"></button>';
            })
            ->rawColumns(['accion'])
            ->make(true);
    }
    /**
     * Lista registros de la base de datos para seleccionar registro
     *
     * @return json data 
     */
    public function datatableSearch(Request $request)
    {
        $model = Inmueble::with('tipo')->get();
        return Datatables::of($model)
            ->addColumn('accion', function ($row) {
                return '<button class="btn btn-xs btn-primary selectInmueble" data-remote="'.route('inmuebles.show',$row->id).'">Seleccionar</button>';
            })
            ->rawColumns(['accion'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(\Request $request)
    {
        //
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
        $inmueble = new Inmueble($request->all());
        $inmueble->save();  

        UbicationRepository::setUbicationToModel($inmueble);

        return response()->json($inmueble);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inmueble = Inmueble::find($id);

        return response()->json($inmueble);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function edit(Inmueble $inmueble)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inmueble = Inmueble::find($id); 
        
        if($request->direccion !== $inmueble->direccion) {
            UbicationRepository::setUbicationToModel($inmueble);
        }

        $inmueble->fill($request->all());
        $inmueble->save();


        return response()->json($inmueble);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inmueble = Inmueble::find($id); 
        $inmueble->delete();

        return response()->json($inmueble->delete());
    }
    
    public function search(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return \Response::json([]);
        }
        $results = Inmueble::where('direccion', 'LIKE', '%'.$term.'%')->limit(10)->get();
        $formatted_result = [];
        foreach ($results as $result) {
            $formatted_result[] = ['id' => $result->id, 'text' => $result->direccion];
        }
        return \Response::json($formatted_result);
    }
}
