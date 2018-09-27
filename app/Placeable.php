<?php

namespace App;

use Dimsav\Translatable\Translatable;

class Placeable extends \Illuminate\Database\Eloquent\Relations\MorphPivot
{
    protected $fillable = ['place_id', 'placeable_type', 'placeable_id', 'deep', 'comment'];


    use Translatable;
    protected $translatedAttributes = ['info_name', 'title', 'intro'];
    public $translationModel = \App\PlaceableTranslation::class;

    /**
     * othrwise,` $item = \App\Placeable::create($data);`  error:
     *   Illuminate\Database\QueryException  : SQLSTATE[42S22]: Column not found: 1054 Unknown column 'placeable_translations.' in 'where clause' (SQL: select * from `placeable_translations` where `placeable_translations`.`` is null and `placeable_translations`.`` is not null)
     * @var string
     */
    protected $translationForeignKey = 'placeable_id';
    protected $table = 'placeables';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

}
