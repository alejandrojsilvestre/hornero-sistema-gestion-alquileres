<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Archivo;

class ApiController extends Controller
{
    /**
     * 
     *  API Propietario
     * 
     */
    public function getDatosPropietario(Request $request)
    {
        // Chequeo que traiga token
        if($request->token){
            $persona = Persona::where('api_token',$request->token)->first();
            if($persona){
                // EL CONTRATO TIENE QUE ESTAR ACTIVO
                $contrato = $persona->contrato_propietario()->first();
                // Declaro Arrays
                $data['cobros_pendientes'] = array();
                $data['cobros_realizados'] = array();
                $data['impuestos_entregados'] = array();
                $data['gastos_pendientes'] = array();
                // Inserto datos en Arrays
                return $data;
            }
        }
    }
    /**
     * 
     *  FIN API Propietario
     * 
     */
}
