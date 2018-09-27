<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Column
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Quote[] $quotes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tree[] $trees
 * @mixin \Eloquent
 */
class Column extends Model
{
    //
    protected $table = 'menu_items';

    use \Dimsav\Translatable\Translatable;
    public $translatedAttributes = ['name','short_name','title','ctitle','desc'];
    public $translationModel = \App\ColumnTranslation::class;
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    public $timestamps = false;

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    function articles()
    {
        return $this->hasMany('App\Article');
    }
    function trees()
    {
        return $this->hasMany('App\Tree');
    }
    public function quotes()
    {
        return $this->morphMany('App\Quote','quoteable');
    }
}
