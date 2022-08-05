<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use OwenIt\Auditing\Models\Audit as AuditModel;

class LogsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $logs = AuditModel::orderBy('created_at', 'desc')->take(10)->get();
        $view->with('logs', $logs);
    }
    public function parseLogs($logs){
        $exceptions = array('App\Monto'=>'created','App\Cobro'=>'created');
        foreach ($logs as $log) {
            if($log->event=='updated'){
                // muestra valor anterior y actual
            }elseif($log->event=='created'){
                // muestra se creo tal cosa
            }else{
                // muestra que se elimino
            }
        }
    }
}