<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PlaceInfo
 *
 * @property-read \App\Place $place
 * @mixin \Eloquent
 */
class PlaceInfo extends Model
{
    function place()
    {
        return $this->belongsTo('App\Place');
    }
}
