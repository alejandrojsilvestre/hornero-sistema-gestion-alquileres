<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends SisModel
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eventos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'id',
        'titulo',
        'direccion',
        'notas',
        'inicio',
        'fin',
        'motivo_id',
        'created_by_id'
    ];
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /*
    ** Relationships
    */
    public function personas()
    {
        return $this->belongsToMany('App\Persona','evento_persona')->withTimeStamps()->using('App\EventoPersona');
    }
    public function inmuebles()
    {
        return $this->belongsToMany('App\Inmueble','evento_inmueble')->withTimeStamps()->using('App\EventoInmueble');
    }
    public function users()
    {
        return $this->belongsToMany('App\User','evento_user')->withTimeStamps();
    }
    public function motivo()
    {
        return $this->belongsTo('App\Motivo');
    }
    public function created_by()
    {
        return $this->belongsTo('App\User');
    }

    /*
    ** Mutators SET para parsear fechas
    */
    public function setInicioAttribute($value)
    {
        $this->attributes['inicio'] = date('Y-m-d H:i:s',strtotime($value));
    }
    public function setFinAttribute($value)
    {
        $this->attributes['fin'] = date('Y-m-d H:i:s',strtotime($value));
    }

    /*
    ** Mutators GET para parsear fechas
    */
    public function getInicioAttribute($value)
    {

        return ($value!='1970-01-01' && $value!='')?date('d-m-Y H:i:s',strtotime($value)):'';
    }
    public function getFinAttribute($value)
    {
        return ($value!='1970-01-01' && $value!='')?date('d-m-Y H:i:s',strtotime($value)):'';
    }

    /*
    ** Notas Sin HTML
    */
    public function getNotas()
    {
        return strip_tags($this->notas);
    }
}
