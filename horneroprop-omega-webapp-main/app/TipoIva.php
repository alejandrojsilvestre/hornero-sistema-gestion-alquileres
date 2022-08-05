<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoIva extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipos_iva';

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
