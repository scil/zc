<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //
    public function experiences()
    {
        return $this->belongsToMany('App\Experience');
    }
}
