<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cuentas';

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
