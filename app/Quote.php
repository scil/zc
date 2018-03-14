<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function places()
    {
        return $this->morphToMany('App\Place', 'placeable')->withPivot('place_name','title','intro','deep','comment');
    }

    function image()
    {
        return $this->belongsTo('App\Image');
    }
    function quoteable()
    {
        return $this->morphTo();
    }
}
