<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\PersonaDeleted;

class PersonaGlobal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'celular',
        'cod_pais',
        'email',
        'tipo_documento_id',
        'nro_documento',
        'tipo_iva_id',
        'nro_cui',
        'direccion',
        'cod_postal',
        'pais',
        'provincia',
        'localidad',
        'barrio',
        'fecha_nacimiento',
        'notas',
        'api_user',
        'api_pass',
        'api_token',
        'sucursal_id',
        'empresa_id',
    ];
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * Traer los tipos de la persona.
     */
}
