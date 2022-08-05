<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Motivo;

class MotivosEventoComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $motivosEventos = Motivo::orderBy('nombre', 'asc')->get()->pluck('nombre','id');
        $view->with('motivosEventos', $motivosEventos);
    }
}