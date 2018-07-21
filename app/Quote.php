<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Quote
 *
 * @property-read \App\Image $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Place[] $places
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $quoteable
 * @mixin \Eloquent
 */
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
