<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AfipInvoice extends SisModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['cae', 'cae_expiration', 'invoice_numer', 'amount', 'iva_amount', 'cobro_id', 'persona_id', 'hash', 'credential_id'];
   
    public function cobro()
    {
        return $this->belongsTo('App\Cobro');
    }

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

    public function afip_credential()
    {
        return $this->belongsTo('App\AfipCredential');
    }

    public function getInvoicePathAttribute() {
        return 'contratos/' . $this->cobro->contrato->id . '/facturas_electronicas/' . $this->id . '/invoice.pdf';
    }
}
