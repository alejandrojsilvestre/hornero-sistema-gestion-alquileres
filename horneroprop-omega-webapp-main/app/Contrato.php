<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends SisModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contratos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'id',
        'inmueble_id',
        'carpeta',
        'telefono',
        'inicio',
        'fin',
        'rescision',
        'cada',
        'porcentaje',
        'moneda_id',
        'monto_garantia',
        'moneda_garantia',
        'interes',
        'interes_vencimiento',
        'interes_inicio',
        'interes_fijo',
        'honorarios',
        'honorarios_fijos',
        'caja_id',
        'cuenta_ingreso_id',
        'cuenta_egreso_id',
        'cuenta_honorarios_id',
        'imputa_iva_honorarios',
        'imputa_iva_punitorios',
        'imputa_iva',
        'punitorios_administracion',
        'punitorios_habil',
        'honorarios_sobre_punitorios',
        'interes_acumulativo',
        'honorarios_sobre_cobrado',
        'notas',
    ];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];


    /**
     * Traer los propietarios del contrato.
     */
    public function propietarios()
    {
        return $this->belongsToMany('App\Persona','contrato_propietario')->withPivot('porcentaje')->withTimeStamps()->using('App\ContratoPropietario');
    }
    /**
     * Traer los inquilinos del contrato.
     */
    public function inquilinos()
    {
        return $this->belongsToMany('App\Persona','contrato_inquilino')->withTimeStamps()->using('App\ContratoInquilino');
    }
    /**
     * Traer los garantes del contrato.
     */
    public function garantes()
    {
        return $this->belongsToMany('App\Persona','contrato_garante')->withTimeStamps()->using('App\ContratoGarante');
    }
    /**
     * Traer las partidas del contrato.
     */
    public function partidas()
    {
        return $this->belongsToMany('App\Partida');
    }
    /**
     * Traer los montos asociados al contrato.
     */
    public function montos()
    {
        return $this->hasMany('App\Monto');
    }
    /**
     * Traer los archvios del contrato.
     */
    public function archivos()
    {
        return $this->belongsToMany('App\Archivo','contrato_archivo')->withTimeStamps()->using('App\ContratoArchivo');
    }
    /**
     * Traer inmueble
     */ 
    public function inmueble()
    {
        return $this->belongsTo('App\Inmueble');
    }
    /**
     * Traer Moneda
     */ 
    public function moneda()
    {
        return $this->belongsTo('App\Moneda');
    }
    /**
     * Traer cobros
     */ 
    public function cobros()
    {
        return $this->hasMany('App\Cobro');
    }
    /**
     * Traer gastos
     */ 
    public function gastos()
    {
        return $this->hasMany('App\Gasto');
    }
    /**
     * Traer impuestos
     */ 
    public function impuestos()
    {
        return $this->hasMany('App\Impuesto');
    }
    /* 
    ** Mutators SET para parsear fechas
    */
    public function setInicioAttribute($value)
    {
        $this->attributes['inicio'] = date('Y-m-d',strtotime($value));
    }
    public function setFinAttribute($value)
    {
        $this->attributes['fin'] = date('Y-m-d',strtotime($value));
    }
    public function setRescisionAttribute($value)
    {
        $this->attributes['rescision'] = date('Y-m-d',strtotime($value));
    }
    /* 
    ** Mutators GET para parsear fechas
    */
    public function getInicioAttribute($value)
    {
        return ($value!='1970-01-01' && $value!='')?date('d-m-Y',strtotime($value)):'';
    }
    public function getFinAttribute($value)
    {
        return ($value!='1970-01-01' && $value!='')?date('d-m-Y',strtotime($value)):'';
    }
    public function getRescisionAttribute($value)
    {
        return ($value!='1970-01-01' && $value!='')?date('d-m-Y',strtotime($value)):'';
    }
}
