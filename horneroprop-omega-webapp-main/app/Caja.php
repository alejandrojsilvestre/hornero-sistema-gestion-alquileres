<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cajas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['id','nombre'];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
