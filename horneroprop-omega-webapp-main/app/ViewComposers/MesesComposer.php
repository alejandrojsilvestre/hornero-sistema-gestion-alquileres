<?php

namespace App\ViewComposers;

use Illuminate\View\View;

class MesesComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $meses = array(1=>'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
               'Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $view->with('meses', $meses);
    }
}