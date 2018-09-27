<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
    //
    protected $fillable = ['title', 'sub_title','desc','intro','intro_md'];
    public $timestamps = false;
}
