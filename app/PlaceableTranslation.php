<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceableTranslation extends Model
{
    //
    protected $fillable = ['info_name','title','intro'];
    public $timestamps = false;
}
