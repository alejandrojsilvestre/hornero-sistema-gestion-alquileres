<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\TipoOrientacion;

class TiposOrientacionComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposOrientacion = TipoOrientacion::orderBy('id','ASC')->pluck('nombre','id');
        $view->with('tiposOrientacion', $tiposOrientacion);
    }
}