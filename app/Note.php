<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
