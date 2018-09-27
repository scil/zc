<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Experience
 *
 * @property-read \App\Person $person
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Place[] $places
 * @mixin \Eloquent
 */
class Experience extends Model
{
    //
    public function person()
    {
        return $this->belongsTo('App\Person');
    }
    public function places()
    {
        return $this->morphToMany('App\Place', 'placeable')
            // todo
            ->withPivot('type');
        // ->withPivot('name','title','intro','comment');
    }
}
