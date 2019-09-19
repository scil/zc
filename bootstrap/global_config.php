<?php
// menu items
const
DEFAULT_LOCAL = 'zh',
ALL_LOCALS = ['zh', 'en',],

COUNTRY_URL = '/foot', STARS_URL='sky', SAIL_URL='sail',SAIL_FULL='/sail',

HOMEPAGE_PLOTS_ARTICLE = 'zhenyi',

HOMEPAGE_PLOTS_QUOTE = [STARS_URL, 'human/Indiv'];

// used by MenuItemsTableSeeder or commands column:blade , column:cache
const
MENU_ID = [
    'main' => 1, // 0 is forbidden, and indicates all menu in MenuItemHelper
    'pass' => 2,
    //    'jia' => 3,
    'bay' => 4
],



MENU_CACHE_DIR = 'bootstrap/cache2',

HOMEPAGE_HEADER=['/zhenyi','/sky','/human/Indiv']

;

if (!defined('MENU_MAP')) {
    include __DIR__ . '/../' . MENU_CACHE_DIR . '/menu_map.php';
}
if (!defined('MENU_ITEMS')) {
    include __DIR__ . '/../' . MENU_CACHE_DIR . '/menu_items.php';
}
if (!defined('ZC_HEADERS')) {
    include __DIR__ . '/../' . MENU_CACHE_DIR . '/headers.php';
}


// \View::share('LOCALE', \App::getLocale());
// \View::share('IS_PJAX', $this->app->make('request')->header('x-pjax', ''));
