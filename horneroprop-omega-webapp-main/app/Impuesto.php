<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends SisModel
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'impuestos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'id',
        'contrato_id',
        'servicio_id',
        'cobro_id',
        'moneda_id',
        'monto',
        'cada',
        'rota',
        'entregado',
        'notas',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * Traer servicio
     */ 
    public function servicio()
    {
        return $this->belongsTo('App\Servicio');
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

}
