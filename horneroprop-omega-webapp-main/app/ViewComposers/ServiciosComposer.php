<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Servicio;

class ServiciosComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposServicio = Servicio::orderBy('nombre', 'asc')->get()->pluck('nombre','id');
        $view->with('tiposServicio', $tiposServicio);
    }
}