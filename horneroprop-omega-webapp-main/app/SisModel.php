<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Schema;
use App\Scopes\EmpresaScope;
class SisModel extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $dates = ['deleted_at'];
    protected $meses = array(1=>'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
               'Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    /**
     * Setea constantes en Querys
     *
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new EmpresaScope);
        /* Funcion para setear automaticamente empresa_id y sucursal_id
        ** segun usuario logueado
		**/
        self::creating(function ($model) {
            if(auth()->user()){
                if(Schema::hasColumn($model->getTable(), 'empresa_id'))
                    $model->empresa_id = auth()->user()->empresa_id;
                if(Schema::hasColumn($model->getTable(), 'sucursal_id'))
                    $model->sucursal_id = auth()->user()->sucursal_id;
            }
        });
    }
}
