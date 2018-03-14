<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    //
    protected $table = 'menu_items';
    public $timestamps = false;

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function quotes()
    {
        return $this->morphMany('App\Quote','quoteable');
    }
}
