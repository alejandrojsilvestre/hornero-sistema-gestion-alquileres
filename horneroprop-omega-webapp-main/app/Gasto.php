<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends SisModel
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gastos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'id',
        'contrato_id',
        'concepto_id',
        'cobro_id',
        'moneda_id',
        'monto',
        'fecha',
        'encargado',
        'pagado_por',
        'rota',
        'cada',
        'liquidado',
        'notas',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * Traer Concepto
     */ 
    public function concepto()
    {
        return $this->belongsTo('App\Concepto');
    }
    /**
     * Traer Cobro
     */ 
    public function cobro()
    {
        return $this->belongsTo('App\Cobro');
    }
    /**
     * Traer Contrato
     */ 
    public function contrato()
    {
        return $this->belongsTo('App\Contrato');
    }
    /**
     * Traer Moneda
     */ 
    public function moneda()
    {
        return $this->belongsTo('App\Moneda');
    }
    /* 
    ** Mutator para parsear fecha
    */
    public function getFechaAttribute($value)
    {
        return ($value!='1970-01-01')?date('d-m-Y',strtotime($value)):'';
    }
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = date('Y-m-d',strtotime($value));
    }

}
