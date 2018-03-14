<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //
    public function person()
    {
        return $this->belongsTo('App\Person');
    }
    public function places()
    {
        return $this->morphToMany('App\Place', 'placeable')->withPivot('place_name','intro','comment');
    }
}
