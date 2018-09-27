<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Place
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Experience[] $experiences
 * @mixin \Eloquent
 */
class Place extends Model
{
    protected $table = 'places';

    use Translatable;
    protected $translatedAttributes = ['name', 'other_names'];
    public $translationModel = \App\PlaceTranslation::class;
    protected $translationForeignKey = 'place_id';
    //
    public function experiences()
    {
        return $this->belongsToMany('App\Experience')
            ->withPivot('name','intro','comment')->using(Placeable::class);

    }
}
