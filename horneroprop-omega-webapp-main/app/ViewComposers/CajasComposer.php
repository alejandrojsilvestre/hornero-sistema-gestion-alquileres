<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Caja;

class CajasComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $cajas = Caja::orderBy('id', 'asc')->get()->pluck('nombre','id');
        $view->with('cajas', $cajas);
    }
}