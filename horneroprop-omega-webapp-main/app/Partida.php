<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends SisModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partidas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
