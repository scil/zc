<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tree
 *
 * @property-read \App\Column $Menu_item
 * @mixin \Eloquent
 */
class Tree extends Model
{
    function Menu_item()
    {
        return $this->belongsTo('App\Column')
//            ->select(['id','short_name','css','url'])
            ;
    }
}
