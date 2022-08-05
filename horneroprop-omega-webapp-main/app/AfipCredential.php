<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AfipCredential extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['business_name', 'responsable_number', 'ib', 'sales_point', 'activity_started_at', 'address', 'email', 'responsable_type_id'];
    
    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = ['key', 'crt'];
    
    /**
     * Relationships
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    public function responsable_type()
    {
        return $this->belongsTo('App\TipoIva');
    }
    /* 
    ** Mutators & Accesors
    */
    public function getActivityStartedAtAttribute($value)
    {
        return ($value!='1970-01-01' && $value!=null) ? date('d-m-Y',strtotime($value)) : '';
    }
    public function setActivityStartedAtAttribute($value)
    {
        $this->attributes['activity_started_at'] = date('Y-m-d',strtotime($value));
    }
}
