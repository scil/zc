<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends BaseModel
{
    use SoftDeletes;

//    protected $fillable = ['title', 'intro', 'body', 'origin', 'origin_url','link','origin_date','copyright','column_id'];

//    public function commentable()
//    {
//        return $this->morphTo();
//    }
    function volume()
    {
        return $this->belongsTo('App\Volume');
    }

    public function articleable()
    {
        return $this->morphTo();
    }

    public function places()
    {
        return $this->morphToMany('App\Place', 'placeable')->withPivot('place_name', 'title', 'intro', 'deep', 'comment');
    }

    public function quotes()
    {
        return $this->morphMany('App\Quote', 'quoteable');
    }

    public function topQuotes()
    {
        // 为什么这样写
        // see: http://stackoverflow.com/questions/26138920/filter-a-polymorphic-table
        return $this->quotes()->where('type', '=', 'top')->orderBy('order');
    }

    public function tailQuotes()
    {
        return $this->quotes()->where('type', '=', 'tail')->orderBy('order');
    }
//    public function quotes()
//    {
//        return $this->belongsToMany('App\Quote')->withPivot('order')->wherePivot('type', 'tail');
//    }

//    public function origin()
//    {
//        return $this->belongsTo('App\Reference','reference_id');
//    }
    public function references()
    {
        return $this->morphMany('App\Reference', 'referenceable');
    }
}
