<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Place
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Experience[] $experiences
 * @mixin \Eloquent
 */
class Place extends Model
{
    //
    public function experiences()
    {
        return $this->belongsToMany('App\Experience');
    }
}
