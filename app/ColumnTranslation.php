<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColumnTranslation extends Model
{
    //
    protected $table = 'menu_item_translations';
    public $fillable  = ['name','short_name','title','ctitle','desc'];
    public $timestamps = false;
}
