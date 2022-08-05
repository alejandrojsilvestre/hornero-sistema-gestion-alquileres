<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends SisModel
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servicios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['nombre'];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
