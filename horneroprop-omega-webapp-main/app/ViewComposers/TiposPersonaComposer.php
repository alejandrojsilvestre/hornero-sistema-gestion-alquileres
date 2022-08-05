<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\TipoPersona;

class TiposPersonaComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposPersona = TipoPersona::orderBy('id', 'asc')->get()->pluck('nombre','id');
        $view->with('tiposPersona', $tiposPersona);
    }
}