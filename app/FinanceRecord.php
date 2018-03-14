<?php
/**
 *
 * y
 * Date: 2015/11/14
 * Time: 20:58
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use DB;

class FinanceRecord extends Model
{
    static function getLast(){
        return DB::table('finance_records')
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();
    }

}