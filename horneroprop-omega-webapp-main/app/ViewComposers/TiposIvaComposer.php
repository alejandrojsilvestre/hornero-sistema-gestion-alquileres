<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\TipoIva;

class TiposIvaComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposIva = TipoIva::orderBy('id', 'asc')->whereActivo(1)->get()->pluck('nombre','id');
        $view->with('tiposIva', $tiposIva);
    }
}