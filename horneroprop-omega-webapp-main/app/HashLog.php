<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashLog extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['source_type', 'source_id', 'ips', 'origin_uri', 'user_agent'];

    public static function generate(String $source, Int $id) {
        static::create([
            'source_type' => $source,
            'source_id' => $id,
            'ips' => request()->ip(),
            'user_agent' => request()->userAgent() ?? '---',
            'origin_uri' => request()->get('origin_uri', null),
        ]);
    }
}
