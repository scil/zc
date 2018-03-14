<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function volume()
    {
        return $this->belongsTo('App\Volume');
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    function image()
    {
        return $this->belongsTo('App\Image');
    }

    function tip()
    {
        return $this->belongsTo('App\Quote', 'tip_id');
    }

    function errata()
    {
        return $this->belongsTo('App\Quote', 'errata_id');
    }

    function versions()
    {
        return $this->hasMany('App\Book');
    }


    public function places()
    {
        return $this->morphToMany('App\Place', 'placeable')->withPivot('place_name', 'title', 'intro', 'deep', 'comment');
    }

    public function mediaQuotes()
    {
        return $this->morphMany('App\MediaQuote', 'quoteable');
    }

    public function quotes()
    {
        return $this->morphMany('App\Quote', 'quoteable');
    }

    public function comments()
    {
        return $this->quotes()->where('type', '=', 'comment')->orderBy('order');
    }

    public function suggestions()
    {
        return $this->quotes()->where('type', '=', 'suggestion')->orderBy('order');
    }

    function articles()
    {
        return $this->morphMany('App\Article', 'articleable')
//            ->orderBy('type','asc')
            ->orderByRaw("FIELD(type, \"review\", \"select\", \"quote\", \"discuss\")")
            ->orderBy('order', 'asc');
    }



//    public function commentArticles()
//    {
//        return  $this->articles()->where('type','=','comment');
//    }
//    public function originArticles()
//    {
//        return  $this->articles()->where('type','=','origin');
//    }
}
