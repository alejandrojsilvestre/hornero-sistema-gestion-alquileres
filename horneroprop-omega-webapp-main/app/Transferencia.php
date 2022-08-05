<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferencia extends SisModel
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transferencias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'id',
        'banco_id',
        'nro',
        'monto',
        'fecha',
        'confirmada',
        'imputada',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * Traer Cobros
     */ 
    public function cobros()
    {
        return $this->belongsToMany('App\Cobro','cobro_transferencia')->withTimeStamps()->using('App\CobroTransferencia');
    }
    /**
     * Traer banco
     */ 
    public function banco()
    {
        return $this->belongsTo('App\Banco');
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
