<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceTranslation extends Model
{
    //
    protected $fillable = ['name', 'other_names'];

    public $timestamps = false;
}
