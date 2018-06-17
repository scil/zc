<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

if (!defined('MENU_ITEMS')) {
    include storage_path() . '/cache/columns.php';
}
if (!defined('ZC_HEADERS')) {
    include storage_path() . '/cache/headers.php';
}

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
