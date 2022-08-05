<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends SisModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pagos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['cobro_id','propietario_id','monto','fecha'];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function cobro()
    {
        return $this->belongsTo('App\Cobro');
    }

    public function propietario()
    {
        return $this->belongsTo('App\Persona');
    }

    public function getFechaAttribute($value)
    {
        return ($value!='1970-01-01' && $value!=null)?date('d-m-Y',strtotime($value)):'';
    }

    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = date('Y-m-d',strtotime($value));
    }

    public function getReceiptPathAttribute() {
        return 'contratos/' . $this->cobro->contrato->id . '/pagos/' . $this->id . '/receipt.pdf';
    }
}
