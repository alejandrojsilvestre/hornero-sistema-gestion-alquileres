<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bancos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = ['id','bcra_id','nombre'];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
