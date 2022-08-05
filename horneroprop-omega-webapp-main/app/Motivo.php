<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivo extends SisModel
{
    //
    protected $table = 'motivos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'nombre',
        'color',
        'sucursal_id',
        'empresa_id'
    ];
	
}
