<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Article
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $articleable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Place[] $places
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Quote[] $quotes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reference[] $references
 * @property-read \App\Volume $volume
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Article onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Article withoutTrashed()
 * @mixin \Eloquent
 */
class Article extends BaseModel
{
    use SoftDeletes;


    use Translatable;
    protected $translatedAttributes = ['title', 'sub_title','desc','intro','intro_md'];
    public $translationModel = \App\ArticleTranslation::class;
    protected $translationForeignKey = 'article_id';


//    protected $fillable = ['title', 'intro', 'body', 'origin', 'origin_url','link','origin_date','copyright','column_id'];

//    public function commentable()
//    {
//        return $this->morphTo();
//    }
    function volume()
    {
        return $this->belongsTo('App\Volume');
    }

    function contents()
    {
        return $this->hasMany('App\Content');
    }

    function htmls()
    {
        return $this->contents()->where('md', '=', false);
    }
    function mds()
    {
        return $this->contents()->where('md', '=', true);
    }

    public function articleable()
    {
        return $this->morphTo();
    }

    public function places()
    {
        // return $this->morphToMany('App\Place', 'placeable')->withPivot('place_name', 'title', 'intro', 'deep', 'comment');
        return $this
            ->morphToMany('App\Place', 'placeable')
            ->withPivot('id','place_id',  'placeable_type', 'placeable_id','deep', 'comment')
            ->using(Placeable::class);
    }

    function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function quotes()
    {
        return $this->morphMany('App\Article', 'articleable');
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
