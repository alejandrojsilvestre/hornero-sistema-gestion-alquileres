<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends SisModel
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movimientos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'monto',
        'moneda_id',
        'cuenta_id',
        'caja_id',
        'fecha',
        'notas',
    ];
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    
    /**
     * Relaciones
     *
     */
    public function personas()
    {
        return $this->belongsToMany('App\Persona','movimiento_persona')->withTimeStamps()->using('App\MovimientoPersona');
    }
    public function contratos()
    {
        return $this->belongsToMany('App\Contrato','movimiento_contrato')->withTimeStamps()->using('App\MovimientoContrato');
    }
    public function cobros()
    {
        return $this->belongsToMany('App\Cobro','movimiento_cobro')->withTimeStamps()->using('App\MovimientoCobro');
    }
    /* 
    ** Mutators SET para parsear fechas
    */
    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = date('Y-m-d H:i:s',strtotime($value));
    }
    /* 
    ** Mutators GET para parsear fechas
    */
    public function getFechaAttribute($value)
    {

        return ($value!='1970-01-01' && $value!='')?date('d-m-Y H:i:s',strtotime($value)):'';
    }
}
