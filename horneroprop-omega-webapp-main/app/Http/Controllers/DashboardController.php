<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends SisController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratosActivosCount = \App\Contrato::get()->count();
        $contratosInactivosCount = \App\Contrato::whereNotNull('rescision')->get()->count();
        $contratosLiquidadosCount = \App\Contrato::where(function ($query) {
                                    return $query->whereHas('cobros', function ($query) {
                                        return $query->whereLiquidado(true)
                                            ->where('mes', date('m'))
                                            ->where('ano', date('Y'));
                                        });
                                    })->get()->count(); 
        $contratosPorLiquidarCount = \App\Contrato::where(function ($query) {
                                    return $query->whereHas('cobros', function ($query) {
                                        return $query->whereLiquidado(false)
                                            ->where('mes', date('m'))
                                            ->where('ano', date('Y'));
                                        });
                                    })->get()->count();  
        $propietariosPorLiquidarCount = \App\Contrato::where(function ($query) {
                                        return $query->whereHas('cobros', function ($query) {
                                            return $query->wherePropietariosLiquidados(false)
                                                ->whereLiquidado(true)
                                                ->where('mes', date('m'))
                                                ->where('ano', date('Y'));
                                            });
                                        })->get()->count();  
        $personasCount = \App\Persona::get()->count();
        $usuariosCount = \App\User::get()->count();

        return view('dashboard')
                    ->with([
                        'contratosActivosCount' => $contratosActivosCount,
                        'contratosInactivosCount' => $contratosInactivosCount,
                        'contratosLiquidadosCount' => $contratosLiquidadosCount,
                        'contratosPorLiquidarCount' => $contratosPorLiquidarCount,
                        'propietariosPorLiquidarCount' => $propietariosPorLiquidarCount,
                        'personasCount' => $personasCount,
                        'usuariosCount' => $usuariosCount
                    ]);
    }
}
