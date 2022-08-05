<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\SubtipoInmueble;

class SubtiposInmuebleComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $subtiposInmueble = SubtipoInmueble::orderBy('nombre','ASC')->pluck('nombre','id');
        $view->with('subtiposInmueble', $subtiposInmueble);
    }
}