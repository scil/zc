<?php
/**
 * User: scil
 * Date: 2018/10/5
 * Time: 8:53
 */

namespace App;


trait Test
{

    static function bootTest()
    {

        var_dump('bootTest');
        static::creating(function ($model) {
            var_dump('creating');
        });
    }

}