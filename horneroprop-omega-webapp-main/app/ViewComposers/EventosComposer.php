<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Evento;

class EventosComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $eventos = Evento::orderBy('inicio', 'asc')->take(10)->get();
        $view->with('eventos', $eventos);
    }
}