<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\TipoDocumento;

class TiposDocumentoComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposDocumento = TipoDocumento::orderBy('id', 'asc')->get()->pluck('nombre','id');
        $view->with('tiposDocumento', $tiposDocumento);
    }
}