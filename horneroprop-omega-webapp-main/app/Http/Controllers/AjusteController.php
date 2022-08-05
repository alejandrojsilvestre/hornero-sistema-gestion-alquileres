<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Sucursal;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Repositories\UbicationRepository;
use Image;
use Storage;

class AjusteController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursal = Sucursal::with('pais', 'provincia', 'localidad')->find($this->user->sucursal_id); 
        return view('ajustes.index')->with('sucursal',$sucursal);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sucursal = Sucursal::find($id); 

        if($request->direccion !== $sucursal->direccion) {
            UbicationRepository::setUbicationToModel($sucursal);
        }

        $sucursal->fill($request->all());
        $sucursal->save();
        
        return response()->json($sucursal);
    }


    // Funcion para subir foto de perfil
    public function uploadLogo (Request $request){
        if(!$request->hasFile('file'))
            return;
        $file=$request->file;

        $user = $this->user;
        $sucursal = Sucursal::find($this->user->sucursal_id);
        $image=Image::make($file)->resize(600, 600)->encode('jpg');
        $pathPhoto='sucursales/'.$sucursal->id.'/'.$file->hashName();
        Storage::put($pathPhoto, $image, 'public');
        $sucursal->logo = $pathPhoto;
        $sucursal->save();

        return response()->json($user);
    }
}
