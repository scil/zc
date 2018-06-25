<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volume extends Model
{
    //
    function column()
    {
        return $this->belongsTo('App\Column')
        // 为什么使用了select , 文章页面就查不到 column
         ->select(['id','short_name','css','url'])
        ;
    }
    function books()
    {
        return $this->hasMany('App\Book');
    }
    function firstBooks()
    {
        return $this->hasMany('App\Book')
            ->where('type','=','first');
    }
    function videos()
    {
        return $this->hasMany('App\Video');
    }
    function firstVideos()
    {
       return $this->hasMany('App\Video')
           ->where('type','=','first');
    }
    function articles()
    {
        return $this->hasMany('App\Article')
            ->orderByRaw("FIELD(type, \"first\", \"normal\", \"note\")")
            ->orderBy('order', 'asc')
            ;
    }
    public function firstArticles()
    {
        return  $this->articles()->where('type','=','first');
    }
    public function firstArticlesSimple()
    {
        return  $this->articles()->select(['id','slug','title','sub_title','desc','intro','volume_id'])->where('type','=','first');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
