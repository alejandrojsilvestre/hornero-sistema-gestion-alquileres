<?php

namespace App\Http\Controllers\Api;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InquilinoController extends Controller
{
    public function getData(Persona $inquilino)
    {
        if($inquilino){
            // EL CONTRATO TIENE QUE ESTAR ACTIVO
            $contrato = $inquilino->contrato_inquilino()->first();

            // Declaro Arrays
            $data['cobros_pendientes'] = array();
            $data['gastos_pendientes'] = array();
            $data['impuestos_pendientes'] = array();
            $data['pagos_realizados'] = array();
            // Inserto datos en Arrays
            $data['cobros_pendientes'] = $contrato->cobros()
            ->where('liquidado',0)
            ->where(function ($query) {
                $query->where('ano', '<',date('Y'))
                        ->orWhere(function ($query) {
                            $query->where('ano', '=',date('Y'))->where('mes', '<=',date('m'));
                        })
                ;})->get();
            $data['gastos_pendientes'] = $contrato->gastos()->with('concepto')->with('cobro')->where('liquidado', 0)->where(function ($query) {$query->where('encargado', 'I')->orWhere('pagado_por', 'I');})->get();
            $data['impuestos_pendientes'] = $contrato->impuestos()->with('servicio')->with('cobro')->where('entregado',0)->get();
            $data['pagos_realizados'] = $contrato->cobros()->where('liquidado',1)->get();
            return response()->json($data);
        }
    }
    public function setFileToContrato(Request $request)
    {
        $response = array('error'=>1,'El archivo no pudo ser almacenado');
        // Chequeo que traiga token
        if($request->token){
            $inquilino = Persona::where('api_token',$request->token)->first();
            if($inquilino){
                // EL CONTRATO TIENE QUE ESTAR ACTIVO
                $contrato = $inquilino->contrato_inquilino()->first();
                if($request->hasFile('file') && $contrato){
                    //guardo el archivo
                    $file = $request->file('file');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->store('uploads/contratos/'.$filename);
                    // Lo guardo en la base de datos y lo agrego a los archivos del contrato
                    $archivo = new Archivo;
                    $archivo->ruta = $path;
                    $archivo->nombre_original = $file->getClientOriginalName();
                    $archivo->tipo = $file->getMimeType();
                    $archivo->extension = $file->getClientOriginalExtension();
                    $archivo->tamano = $file->getClientSize();
                    $archivo->fecha = date('Y-m-d');
                    $archivo->save();
                    $contrato->archivos()->attach($archivo);
                    $response = array('error'=>0,'text'=>'El achivo se subio correctamente');
                }
            }
        }
        return $response;
    }
}
