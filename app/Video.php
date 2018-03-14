<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    public function volume()
    {
        return $this->belongsTo('App\Volume');
    }

    function tip()
    {
        return $this->belongsTo('App\Quote', 'tip_id');
    }
    function behind()
    {
        return $this->belongsTo('App\Quote', 'behind_id');
    }
    public function mediaQuotes()
    {
        return $this->morphMany('App\MediaQuote', 'quoteable');
    }
    function articles()
    {
        return $this->morphMany('App\Article', 'articleable')
//            ->orderBy('type','asc')
            ->orderByRaw("FIELD(type, \"review\", \"select\", \"quote\", \"discuss\")")
            ->orderBy('order','asc')
            ;
    }
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
    function image()
    {
        return $this->belongsTo('App\Image');
    }
    public function quotes()
    {
        return $this->morphMany('App\Quote','quoteable');
    }
    public function comments()
    {
        return  $this->quotes()->where('type','=','comment')->orderBy('order');
    }
    public function places()
    {
        return $this->morphToMany('App\Place', 'placeable')->withPivot('place_name','intro','deep','comment');
    }
}
