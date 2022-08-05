<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Notificacion;

class NotificacionesComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $notificaciones = Notificacion::orderBy('created_at', 'desc')->take(10)->get();
        $view->with('notificaciones', $notificaciones);
    }
}