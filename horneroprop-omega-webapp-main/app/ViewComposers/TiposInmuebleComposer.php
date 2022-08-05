<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\TipoInmueble;

class TiposInmuebleComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposInmueble = TipoInmueble::orderBy('id','ASC')->pluck('nombre','id');
        $view->with('tiposInmueble', $tiposInmueble);
    }
}