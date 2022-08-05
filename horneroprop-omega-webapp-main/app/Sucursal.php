<?php

namespace App;

use Storage;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sucursales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'razon_social',
        'direccion',
        'telefono',
        'email',
        'web',
        'cod_postal',
        'tipo_iva_id',
        'nro_cui',
        'ingresos_brutos',
        'punto_venta',
        'inicio_actividades',
        'logo',
        'smtp_server',
        'smtp_user',
        'smtp_pass',
        'smtp_port',
        'lat',
        'lng',
        'empresa_id',
    ];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    
    /**
     * Relationships
     */
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
    /* 
    ** Mutator para parsear fecha
    */
    public function getInicioActividadesAttribute($value)
    {
        return ($value!='1970-01-01' && $value!=null)?date('d-m-Y',strtotime($value)):'';
    }
    public function setInicioActividadesAttribute($value)
    {
        $this->attributes['inicio_actividades'] = date('Y-m-d',strtotime($value));
    }

    public function logo($type=null)
    {
        if(!$this->logo)
            return null;

        if($type=='base64'){
           
            return 'data:image/png;base64,'.base64_encode(file_get_contents(Storage::url($this->logo)));
        }else
            return Storage::url($this->logo);
    }
}
