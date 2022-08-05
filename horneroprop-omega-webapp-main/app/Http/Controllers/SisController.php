<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SisController extends Controller
{
    public function __construct()
    {
      	$this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function addNotificacion($texto, $enlace, $contrato = null, $persona = null){
    	$notificacion = new \App\Notificacion;
    	$notificacion->enlace = $enlace;
    	$notificacion->texto = $texto;
    	$notificacion->save();
    	if($contrato)
    		$notificacion->contrato()->attach($contrato);
    	if($persona)
    		$notificacion->persona()->attach($persona);
    }
}
