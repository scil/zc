<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
