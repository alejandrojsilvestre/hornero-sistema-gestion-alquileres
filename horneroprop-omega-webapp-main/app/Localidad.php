<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localidades';

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
