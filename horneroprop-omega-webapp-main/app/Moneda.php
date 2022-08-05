<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'monedas';

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
