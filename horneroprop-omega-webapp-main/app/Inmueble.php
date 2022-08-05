<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inmueble extends SisModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inmuebles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'id',
        'direccion',
        'tipo_id',
        'subtipo_id',
        'celular',
        'ambientes',
        'dormitorios',
        'banos',
        'toilettes',
        'cocheras',
        'antiguedad',
        'emprendimiento_id',
        'condicion_id',
        'orientacion_id',
        'disposicion_id',
        'sup_terreno',
        'sup_cubierta',
        'sup_descubierta',
        'sup_semicubierta',
        'sup_total',
        'lat',
        'lng',
        'cod_postal',
    ];
    /**
     * Relationships
     */ 
    public function tipo()
    {
        return $this->belongsTo('App\TipoInmueble');
    }

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Provincia');
    }

    public function localidad()
    {
        return $this->belongsTo('App\Localidad');
    }
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
