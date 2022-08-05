<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monto extends SisModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contrato_montos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['monto','desde','hasta'];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Traer el contrato al que pertenece el monto.
     */
    public function contrato()
    {
        return $this->belongsTo('App\Contrato');
    }

    /* 
    ** Mutators SET para parsear fechas
    */
    public function setDesdeAttribute($value)
    {
        $this->attributes['desde'] = date('Y-m-d',strtotime($value));
    }
    public function setHastaAttribute($value)
    {
        $this->attributes['hasta'] = date('Y-m-d',strtotime($value));
    }
    /* 
    ** Mutators GET para parsear fechas
    */
    public function getDesdeAttribute($value)
    {
        return ($value!='1970-01-01' && $value!='')?date('d-m-Y',strtotime($value)):'';
    }
    public function getHastaAttribute($value)
    {
        return ($value!='1970-01-01' && $value!='')?date('d-m-Y',strtotime($value)):'';
    }
}
