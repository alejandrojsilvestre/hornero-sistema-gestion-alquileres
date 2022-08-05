<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends SisModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notificaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['id','texto','enlace','created_at'];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Traer el contrato.
     */
    public function contrato()
    {
        return $this->belongsToMany('App\Contrato','notificacion_contrato')->withTimeStamps()->using('App\NotificacionContrato');
    }
    /**
     * Traer la persona.
     */
    public function persona()
    {
        return $this->belongsToMany('App\Persona','notificacion_persona')->withTimeStamps()->using('App\NotificacionPersona');
    }
}
