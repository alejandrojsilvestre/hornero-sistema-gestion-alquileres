<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Concepto;

class ConceptosComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tiposConcepto = Concepto::orderBy('nombre', 'asc')->get()->pluck('nombre','id');
        $view->with('tiposConcepto', $tiposConcepto);
    }
}