<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends SisModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'archivos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'id',
        'nombre_original',
        'nombre',
        'tipo',
        'extension',
        'tamano',
        'fecha',
    ];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * Traer los contratos del archivo.
     */
    public function contratos()
    {
        return $this->belongsToMany('App\Contrato','contrato_archivo')->withTimeStamps()->using('App\ContratoArchivo');
    }
}

