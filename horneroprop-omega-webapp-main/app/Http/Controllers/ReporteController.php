<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use App\Contrato;

class ReporteController extends Controller
{
    public function contratos_vigentes()
    {
        $contratosActivos = Contrato::whereNull('rescision')->get();
        return $this->download_pdf('contratos_vigentes', $contratosActivos);
    }

    public function contratos_inactivos()
    {
        $contratosInactivos = Contrato::whereNotNull('rescision')->get();
        return $this->download_pdf('contratos_inactivos', $contratosInactivos);
    }

    public function inquilinos_cobrar()
    {
        $contratosPorLiquidar = Contrato::where(function ($query) {
                                return $query->whereHas('cobros', function ($query) {
                                    return $query->whereLiquidado(false)
                                        ->where('mes', date('m'))
                                        ->where('ano', date('Y'));
                                    });
                                })->get();  
        return $this->download_pdf('inquilinos_cobrar', $contratosPorLiquidar);
    }

    public function propietarios_pagar()
    {

        $propietariosPorLiquidar = Contrato::where(function ($query) {
                                        return $query->whereHas('cobros', function ($query) {
                                            return $query->wherePropietariosLiquidados(false)
                                                ->whereLiquidado(true)
                                                ->where('mes', date('m'))
                                                ->where('ano', date('Y'));
                                            });
                                        })->get();  
        return $this->download_pdf('propietarios_pagar', $propietariosPorLiquidar);
    }

    public function caja_diaria(){
        
        return $this->download_pdf('caja_diaria');
    }

    public function movimientos_mes(){
        
        return $this->download_pdf('movimientos_mes');
    }

    private function download_pdf(String $view, $data = []){ 
        $pdf = PDF::loadView('reportes.' . $view, ['data' => $data]);
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->download($view.'_'.date('Ymd').'.pdf');
    }

}
