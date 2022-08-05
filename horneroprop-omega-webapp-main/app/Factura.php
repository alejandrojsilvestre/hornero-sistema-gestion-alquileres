<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends SisModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['cobro_id', 'propietario_id', 'monto', 'fecha', 'hash'];
   
    public function cobro()
    {
        return $this->belongsTo('App\Cobro');
    }

    public function propietario()
    {
        return $this->belongsTo('App\Persona');
    }

    public function getInvoicePathAttribute() {
        return 'contratos/' . $this->cobro->contrato->id . '/facturas/' . $this->id . '/invoice.pdf';
    }
}
