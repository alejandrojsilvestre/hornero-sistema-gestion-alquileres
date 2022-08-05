<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Scopes\EmpresaScope;
use Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'nombre',
        'apellido',
        'telefono',
        'cod_pais',
        'celular',
        'tipo_documento_id',
        'nro_documento',
        'tipo_iva_id',
        'nro_cui',
        'caja_id',
        'direccion',
        'cod_postal',
        'lat',
        'lng',
        'fecha_nacimiento',
        'notas',
        'smtp',
        'firma',
        'foto',
        'sucursal_id',
        'empresa_id',
        'password'
    ];

	/**
	 * The atributtes from accesors.
	 *
	 */
    protected $appends = ['fullname'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Setea constantes en Querys
     *
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new EmpresaScope);

        self::creating(function ($model) {
            $model->empresa_id = auth()->user()->empresa_id ?? $model->empresa_id;
            $model->sucursal_id = auth()->user()->sucursal_id ?? $model->sucursal_id;
        });
    }

    /**
     * Relationships
     */

    public function sucursal()
    {
      return $this->belongsTo('App\Sucursal');
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

    public function afip_credentials()
    {
      return $this->belongsToMany('App\AfipCredential');
    }

    public function eventos()
    {
      return $this->belongsToMany('App\Evento');
    }
    /**
     * Accesors & Mutators
     */
    public function getFullName()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    public function getFullnameAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    public function getFechaNacimientoAttribute($value)
    {
        return ($value !== null) ? date('d-m-Y', strtotime($value)) : '';
    }

    public function setFechaNacimientoAttribute($value)
    {
        if ($value) {
            $this->attributes['fecha_nacimiento'] = date('Y-m-d', strtotime($value));
        }
    }

    public function setPasswordAttribute($value) {
        $value ?
            $this->attributes['password'] = bcrypt($value): null;
    }

    public function foto()
    {
        if(!$this->foto)
            return null;

        return Storage::url($this->foto);
    }
}
