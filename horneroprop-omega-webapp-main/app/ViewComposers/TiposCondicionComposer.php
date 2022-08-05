<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\TipoCondicion;

class TiposCondicionComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposCondicion = TipoCondicion::orderBy('id','ASC')->pluck('nombre','id');
        $view->with('tiposCondicion', $tiposCondicion);
    }
}