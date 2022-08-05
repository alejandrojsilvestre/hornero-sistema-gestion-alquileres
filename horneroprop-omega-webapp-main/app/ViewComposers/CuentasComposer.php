<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Cuenta;

class CuentasComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cuentas = Cuenta::orderBy('id', 'asc')->get()->pluck('nombre','id');
        $view->with('cuentas', $cuentas);
    }
}