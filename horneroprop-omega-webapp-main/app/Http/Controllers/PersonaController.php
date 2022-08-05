<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Repositories\UbicationRepository;

class PersonaController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personas.list');
    }
    /**
     * Lista registros de la base de datos 
     *
     * @return json data 
     */
    public function datatable(Request $request)
    {
        $model = Persona::all();
        return Datatables::of($model)     
            ->addColumn('accion', function ($row) {
                return '<button class="btn btn-xs btn-primary editarPersona" data-remote="'.route('personas.show',$row->id).'">Ver</button>
                    <button class="btn btn-xs btn-danger btn-delete" data-remote="'.route('personas.destroy',$row->id).'"><i class="la la-trash white"></button>';
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
        $model = Persona::all();
        return Datatables::of($model)
            ->addColumn('accion', function ($row) {
                return '<button class="btn btn-xs btn-primary selectPersona" data-remote="'.route('personas.show',$row->id).'">Seleccionar</button>';
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
        $persona = new Persona($request->all());

        $persona->save();
        $persona->tipos()->sync($request->tipos);
        
        UbicationRepository::setUbicationToModel($persona);

        return response()->json($persona);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $persona = Persona::find($id);
        $tipos = $persona->tipos()->get();
        foreach ($tipos as $tipo) {
            $data['tipos'][] = $tipo->pivot->tipo_persona_id;
        }
        $data['tipos'] = json_encode($data['tipos']?? []);
        $data['persona'] = $persona->toJson();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);
        return view('personas.form')->with('persona',$persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $persona = Persona::find($id); 

        if($request->direccion !== $persona->direccion) {
            UbicationRepository::setUbicationToModel($persona);
        }
        
        $persona->fill($request->all());
        $persona->save();
        $persona->tipos()->sync($request->tipos);


        return response()->json($persona);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id); 
        $persona->delete();

        return response()->json($persona->delete());
    }
    
    public function search(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return \Response::json([]);
        }
        $results = Persona::where('nombre', 'LIKE', '%'.$term.'%')->limit(10)->get();
        $formatted_result = [];
        foreach ($results as $result) {
            $formatted_result[] = ['id' => $result->id, 'text' => $result->nombre.' '.$result->apellido];
        }
        return \Response::json($formatted_result);
    }
    /**
     *
     *  FUNCIONES PARA EVITAR DUPLICADO DE INFORMACION
     *
     */
    public function checkUser(Request $request){
        if ($request->user) {
            $persona = new \App\PersonaGlobal;
            $persona = $persona->where('api_user', $request->user)->first();
            if($persona)
                return response()->json(array('error' => 1, 'text' => 'Info: Ya existe una persona con este usuario, deberá modificarlo para poder guardar el formulario.'));
        }
    }
    public function checkTelefono(Request $request){
        if ($request->telefono) {
            $persona = new Persona;
            $persona = $persona->where('telefono', $request->telefono)->first();
            if($persona)
                return response()->json(array('error' => 1, 'text' => 'Info: Ya existe una persona con este telefono, recomendamos buscar la persona para asignar datos.'));
        }
    }
    public function checkCelular(Request $request){
        if ($request->celular) {
            $persona = new \App\Persona;
            $persona = $persona->where('celular',$request->celular)->first();
            if($persona)
                return response()->json(array('error' => 1, 'text' => 'Info: Ya existe una persona con este celular, recomendamos buscar la persona para asignar datos.'));
        }
   }
    public function checkMail(Request $request){
        if ($request->email) {
            $persona = new \App\Persona;
            $persona = $persona->where('email',$request->email)->first();
            if($persona)
                return response()->json(array('error' => 1, 'text' => 'Info: Ya existe una persona con este email, recomendamos buscar la persona para asignar datos.'));
        }
    }
    public function checkDocumento(Request $request){
        if ($request->nro_documento) {
            $persona = new \App\Persona;
            $persona = $persona->where('nro_documento',$request->nro_documento)->first();
            if($persona)
                return response()->json(array('error' => 1, 'text' => 'Info: Ya existe una persona con este nro. de documento, recomendamos buscar la persona para asignar datos.'));
        } 
    }
    /**
     *
     *  FIN FUNCIONES PARA EVITAR DUPLICADO DE INFORMACION
     *
     */
}
