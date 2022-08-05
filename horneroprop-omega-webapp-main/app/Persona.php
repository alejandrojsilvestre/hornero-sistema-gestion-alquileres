<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\PersonaDeleted;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Schema;
use App\Scopes\EmpresaScope;

class Persona extends Authenticatable implements JWTSubject, Auditable
{
    use Notifiable;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $meses = array(1=>'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
               'Agosto','Septiembre','Octubre','Noviembre','Diciembre');

       /**
     * Setea constantes en Querys
     *
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new EmpresaScope);
        /* Funcion para setear automaticamente empresa_id y sucursal_id
        ** segun usuario logueado
		**/
        self::creating(function ($model) {
            if(auth()->user()){
                if(Schema::hasColumn($model->getTable(), 'empresa_id'))
                    $model->empresa_id = auth()->user()->empresa_id;
                if(Schema::hasColumn($model->getTable(), 'sucursal_id'))
                    $model->sucursal_id = auth()->user()->sucursal_id;
            }
        });
    }

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
        'cod_pais',
        'celular',
        'email',
        'tipo_documento_id',
        'nro_documento',
        'tipo_iva_id',
        'nro_cui',
        'direccion',
        'cod_postal',
        'lat',
        'lng',
        'fecha_nacimiento',
        'notas',
        'api_user',
        'api_pass',
        'sucursal_id',
        'empresa_id',
    ];
    protected $dispatchesEvents = [
        'deleted' => PersonaDeleted::class,
    ];

	/**
	 * The atributtes from accesors.
	 *
	 */
    protected $appends = ['es_propietario', 'es_inquilino', 'fullname'];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['api_pass'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
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

    public function tipos()
    {
        return $this->belongsToMany('App\TipoPersona','persona_tipo')->withTimeStamps()->using('App\PersonaTipoPersona');
    }

    public function contrato_propietario()
    {
        return $this->belongsToMany('App\Contrato','contrato_propietario')->withTimeStamps()->using('App\ContratoPropietario');
    }

    public function contrato_inquilino()
    {
        return $this->belongsToMany('App\Contrato','contrato_inquilino')->withTimeStamps()->using('App\ContratoInquilino');
    }

    public function contrato_garante()
    {
        return $this->belongsToMany('App\Contrato','contrato_garante')->withTimeStamps()->using('App\ContratoGarante');
    }

    public function tipo_documento()
    {
        return $this->belongsTo('App\TipoDocumento');
    }

    public function tipo_iva()
    {
        return $this->belongsTo('App\TipoIva');
    }

    /*
     * Mutators & Accesors
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

    public function setApiPassAttribute($value) {
        $value ?
            $this->attributes['api_pass'] = bcrypt($value): null;
    }

    public function getEsPropietarioAttribute() {
        return ($this->tipos()->where('tipo_persona_id', 1)->first()) ? true : false;
    }

    public function getEsInquilinoAttribute() {
        return ($this->tipos()->where('tipo_persona_id', 2)->first()) ? true : false;
    }

}
