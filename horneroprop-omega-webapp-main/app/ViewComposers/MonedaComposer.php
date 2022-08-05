<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Moneda;

class MonedaComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $monedas = Moneda::orderBy('id','ASC')->pluck('signo','id');
        $view->with('monedas', $monedas);
    }
}