<?php
/**
 *
 * y
 * Date: 2015/11/24
 * Time: 18:27
 */

namespace App\Services;

use DB;

trait Header
{
    protected function header($data = array())
    {
        return
            $this->viewFromTo('partials.columns.header', $data, null, true);
    }

    protected function mainMenuHeaders()
    {
        echo "  # start main menu header\n";

        $topId = $this->topMenuItemId['main'];

        $headerAll = [];

        $columns = $this->allItemsById;

        $localeBackup = app()->getLocale();

        foreach (ALL_LOCALS as $locale) {
            app()->setLocale($locale);
            $title = __('Zhenc');
            \View::share('URL_LOCALE_PREFIX', $locale === DEFAULT_LOCAL ? '' : "/$locale");
            echo "\n  # locale: $locale\n";

            $headerAll[$locale] = [];
            $header = &$headerAll[$locale];

            foreach ($columns[$topId]->children as $level1id) {
                $level1 = $columns[$level1id];
                echo " level-1 {$level1->name} $level1id \n";
                if ($level1->children) {
                    foreach ($level1->children as $level2id) {
                        $level2 = $columns[$level2id];

                        $header_intro = $level2->name === '越海' ? '开拓人类之路' : null;

                        echo "    level-2 {$level2->name}  $level2id:\n";

                        $header[$level2id] = $this->header(['leftColumn' => $level2, 'title' => ($level2->name) . ' &nbsp;|&nbsp; ' . $title, 'header_intro' => $header_intro]);

                        // a simple title for article
                        if (in_array($level2->name, ['书架', '视窗', 'Video Window', 'Bookshelf'])) {
                            $header[$level2id] = $this->header(['leftColumn' => $level2, 'title' => $title . ($level2->name)]);
                        }


                        if ($level2->children) {
                            foreach ($level2->children as $level3id) {
                                $level3 = $columns[$level3id];
                                echo "      level-3 {$level3->name } $level3id\n";
                                // title 显示$level2的名字
                                $header[$level3id] = $this->header(['leftColumn' => $level2, 'activeId' => $level3id, 'title' => ($level3->name) . ' &nbsp;|&nbsp; ' . $title . $level2->name, 'header_intro' => $header_intro]);


                            }
                        }
                    }
                }
            }
        }

        app()->setLocale($localeBackup);
        return $headerAll;
    }

    protected function twoLevelHeaders($menuUrlPrefix)
    {
        if (!isset(static::menuId[$menuUrlPrefix])) {
            echo 'wrong for  menu url-prefix : ', $menuUrlPrefix;
            return;
        }

        echo "  # start $menuUrlPrefix header\n";

        $headerRoot = [];

        $leftColumnId = $this->topMenuItemId[$menuUrlPrefix];
        $leftColumn = $this->allItemsById[$leftColumnId];


        $localeBackup = app()->getLocale();

        foreach (ALL_LOCALS as $locale) {
            app()->setLocale($locale);
            \View::share('URL_LOCALE_PREFIX', $locale === DEFAULT_LOCAL ? '/' : "/$locale");

            $headerRoot[$locale] = [];
            $header =& $headerRoot[$locale];

            $title = $leftColumn->name;
            $header[$leftColumnId] = $this->header(compact('leftColumn', 'title'));
            foreach ($leftColumn->children as $activeId) {
                $activeColumn = $this->allItemsById[$activeId];
                $title = $activeColumn->name;
                $header[$activeId] = $this->header(compact('leftColumn', 'activeId', 'title'));
            }
        }

        app()->setLocale($localeBackup);
        return $headerRoot;
    }

}

trait Cache
{

    use Header;

    /**
     * php artisan column:cache
     *
     * bootstrap/cache2/menu_items.php
     * bootstrap/cache2/menu_map.php
     * bootstrap/cache2/headers.php
     */
    protected function makeColumnsCache()
    {
        echo "### make cache in ", MENU_CACHE_DIR, "\n";

        @mkdir(base_path(MENU_CACHE_DIR));

        $file = base_path(MENU_CACHE_DIR . '/menu_items.php');
        file_put_contents($file, '<?php '
            . '// ' . __FILE__ . __METHOD__ . "\n"
            . 'const MENU_ITEMS = '
            . var_export(MenuItemHelper::getMenuItemsInfo(0), true)
            . '   ; ?>'
        );

        $file = base_path(MENU_CACHE_DIR . '/menu_map.php');
        file_put_contents($file, '<?php '
            . '// ' . __FILE__ . __METHOD__ . "\n"
            . 'const MENU_MAP = '
            . var_export(MenuItemHelper::getUrlMapId(0), true)
            . '   ; ?>'
        );

        $pass = $this->twoLevelHeaders('pass');
        $main = $this->mainMenuHeaders();


        foreach (ALL_LOCALS as $locale) {

            app()->setLocale($locale);
            \View::share('URL_LOCALE_PREFIX', $locale === DEFAULT_LOCAL ? '/' : "/$locale");
            $homeLeft = new \stdClass();
            $homeLeft->url = '';
            $homeLeft->name = __('Zhenc City');
            foreach (HOMEPAGE_HEADER as $url){
                $id = \App\Column::where('url',$url)->first()->id;
                $homeLeft->children[] = $id;
            }
            $homepage = [0 => $this->header(['leftColumn' => $homeLeft, 'header_intro' => ''])];
            var_dump($homepage);

            $headers[$locale] = $homepage + $main[$locale] + $pass[$locale];
        }

        $file = base_path(MENU_CACHE_DIR . '/headers.php');
        file_put_contents($file, '<?php '
            . '// ' . __FILE__ . __METHOD__ . "\n"
            . 'const ZC_HEADERS = '
            . var_export($headers, true)
            . '   ; ?>'
        );

    }
}

trait Finance
{

    /**
     * open tinker and run:
     * ( new \App\Services\Staticizer)->createFinanceData();
     */
    function createFinanceData()
    {
        $data['financeRecords'] = \App\FinanceRecord::getLast();
        $this->partial('country.finance', $data, 'country._finance');
    }

}

class Staticizer
{
    use Cache;
    use Finance;

    const menuId = MENU_ID;

    var $topMenuItemId = [];
    var $allItemsById;

    function __construct()
    {

        foreach (static::menuId as $name => $id) {
            $this->topMenuItemId[$name] = MenuItemHelper::getTopItemId($id);
        }

        $this->allItemsById = view()->share('COLUMNS_INFO', MenuItemHelper::getAllItemObjectsById());

        view()->share('topId', $this->topMenuItemId['main']);

        if (isset($this->topMenuItemId['game']))
            view()->share('GAME_TOP_ID', $this->topMenuItemId['game']);

    }


    /**
     *
     * php artisan column:cache
     * php artisan column:blade
     *
     * or
     * open tinker and run:
     * ( new \App\Services\Staticizer)->makeColumnsCacheAndBlade();
     */
    function makeColumnsCacheAndBlade($method = null, ...$params)
    {

        if ($method) {
            $this->$method(...$params);
            return;
        }

        // php artisan column:cache
        $this->makeColumnsCache();
        $this->makeColumnsBlade();

    }

    function makeColumnsBlade()
    {
        \File::deleteDirectory(base_path() . '/resources/views/partials/columns');
        \File::deleteDirectory(base_path() . '/resources/views/layouts/columns');

        $localeBackup = app()->getLocale();

        foreach (ALL_LOCALS as $locale) {
            app()->setLocale($locale);
            \View::share('URL_LOCALE_PREFIX', $locale === DEFAULT_LOCAL ? '' : "/$locale");

            echo "### blade for navbar, and  " . COUNTRY_URL . " not render sub menu.\n";
            $this->partial('columns.navbar-nav-left', [], 'columns._navbar-nav-left-' . $locale);

            echo "### blade for home site map \n";
            $this->partial('columns.home-sitemap', [], 'columns._map-' . $locale);

            // ### home
            echo "### blade for home-body\n";
            $ids = DB::table('menu_items')->whereIn('url', ['/zhen', '/human'])->pluck('id');
            $this->partial('columns.home-body', compact('ids'), 'columns._home-body-' . $locale);
        }
        app()->setLocale($localeBackup);

        $this->_columnsSelect(2); // 2 is the id of shanshui column


    }

    protected function viewFromTo($viewName, $data = array(), $newName = null, $echoBlade = false)
    {
        $oView = view('_s.' . $viewName, $data);

        try {
            $r = $oView->render();
            $r = $this->sanitize_output($r);
            $newName = base_path() . '/resources/views/' . str_replace('.', '/', $newName);
            $newName .= $echoBlade ? '.blade.php' : '.php';
            if (is_string($newName)) {
                @mkdir(dirname($newName), 0777, true);
                file_put_contents($newName, $r, LOCK_EX);
            }
            return $r;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    protected function partial($viewName, $data = array(), $newName = null, $echoBlade = false)
    {
        return $this->viewFromTo('partials.' . $viewName, $data, is_null($newName) ? null : 'partials.' . $newName, $echoBlade);
    }


    protected function sanitize_output($buffer)
    {

        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );

        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );

        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
    }

    // html select : <select></select>
    protected function _columnsSelect($level1id)
    {
        echo "### blade for <select> opt \n";
        $this->partial('columns.select_column_under_a_level1', compact('level1id'), 'columns._select_opt_shanshui');
    }


}