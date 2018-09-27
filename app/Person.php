<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Person
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Experience[] $experiences
 * @property-read \App\Place $place
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reference[] $references
 * @mixin \Eloquent
 */
class Person extends Model
{

    protected $table = 'persons';

    //
//    public function articles()
//    {
//        return $this->hasMany('App\Articles');
//    }
    function place()
    {
        return $this->belongsTo('App\Place');
    }

    public function experiences()
    {
        return $this->hasMany('App\Experience');
    }

    public function references()
    {
        return $this->morphMany('App\Reference', 'referenceable');
    }
}
