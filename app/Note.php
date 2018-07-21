<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Note
 *
 * @property-read \App\Volume $volume
 * @mixin \Eloquent
 */
class Note extends Model
{
    //
//    public function article()
//    {
//        return $this->belongsTo('App\Person');
//    }
    function volume()
    {
        return $this->belongsTo('App\Volume');
    }
}
