<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCondicion extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipos_condicion';

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
