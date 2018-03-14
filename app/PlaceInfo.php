<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceInfo extends Model
{
    function place()
    {
        return $this->belongsTo('App\Place');
    }
}
