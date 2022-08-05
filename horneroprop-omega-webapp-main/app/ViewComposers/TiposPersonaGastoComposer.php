<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\TipoPersona;

class TiposPersonaGastoComposer
{

    public $tiposPersonaGasto = array('P' => 'Propietario', 'I' => 'Inquilino', 'A' => 'Administracion');
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tiposPersonaGasto', $this->tiposPersonaGasto);
    }
}