<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empresas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['razon_social'];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * Traer empresa
     */ 
    public function sucursales()
    {
        return $this->hasMany('App\Sucursal');
    }
}
