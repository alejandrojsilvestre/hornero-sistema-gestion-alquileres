<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Banco;

class BancosComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $bancos = Banco::orderBy('nombre', 'asc')->get()->pluck('nombre','id');
        $view->with('bancos', $bancos);
    }
}