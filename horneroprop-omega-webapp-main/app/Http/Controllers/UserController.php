<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Repositories\UbicationRepository;
use Image;
use Auth;
use Storage;

class UserController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.list');
    }
    /**
     * Lista registros de la base de datos
     *
     * @return json data
     */
    public function datatable()
    {
        $model = User::all();
        return Datatables::of($model)
            ->addColumn('accion', function ($row) {
                $return='<button class="btn btn-primary editarUser" data-remote="'.route('usuarios.show',$row->id).'">Ver</button> ';

                if($row->id != Auth::user()->id)
                    $return .='<button class="btn btn-danger btn-delete" data-remote="'.route('usuarios.destroy',$row->id).'"><i class="la la-trash"></button>';

                return $return;
            })
            ->rawColumns(['accion'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $user = new User($request->all());
        $user->password = bcrypt($request->password);

        UbicationRepository::setUbicationToModel($user);

        $user->save();

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::with('pais', 'provincia', 'localidad')->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.form')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id); 

        if($request->direccion !== $user->direccion) {
            UbicationRepository::setUbicationToModel($user);
        }

        $user->fill($request->all());
        $user->save();


        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id); 
        $user->delete();

        return response()->json($user->delete());
    }

    // Funcion para subir foto de perfil
    public function uploadPhoto (Request $request){
        if(!$request->hasFile('file'))
            return;
        $file = $request->file;

        $user = $this->user;
        $image = Image::make($file)->resize(300, 300)->encode('jpg');
        $pathPhoto = 'users/' . $user->id . '/avatar/' . $file->hashName();
        Storage::put($pathPhoto, $image, 'public');
        $user->foto = $pathPhoto;
        $user->save();

        return response()->json($user);
    }
}

