<?php

namespace App;

use Astrotomic\Translatable\Translatable;;

class Placeable extends \Illuminate\Database\Eloquent\Relations\MorphPivot
 implements  \Astrotomic\Translatable\Contracts\Translatable
{
    protected $fillable = ['place_id', 'placeable_type', 'placeable_id', 'deep', 'comment'];


    use Translatable;
    protected $translatedAttributes = ['info_name', 'title', 'intro'];
    public $translationModel = \App\PlaceableTranslation::class;
    /**
     * othrwise,` $item = \App\Placeable::create($data);`  error:
     * cause: there's a column named 'placeable_id' in talbe placeables
     *
     * @var string
     */
    protected $translationForeignKey = 'placeable_table_id';
    # https://github.com/Astrotomic/laravel-translatable/issues/19
    public $incrementing = true;

    protected $table = 'placeables';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

}
