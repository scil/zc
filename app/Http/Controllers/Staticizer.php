<?php
/**
 *
 * y
 * Date: 2015/11/24
 * Time: 18:27
 */

namespace App\Http\Controllers;

use App\MenuItemHelper;
use DB;

class Staticizer
{
    var $menuId = ['main' => 1, 'pass' => 2,]; //  'game' => 3];
    var $topItemId = [];
    var $columns;

    function __construct()
    {
        foreach ($this->menuId as $name => $id) {
            $this->topItemId[$name] = MenuItemHelper::getTopItemId($id);
        }

        $this->columns = view()->share('columns', MenuItemHelper::getAllItems());

        view()->share('topId', $this->topItemId['main']);

        if (isset($this->topItemId['game']))
            view()->share('gameTopId', $this->topItemId['game']);

    }

    /**
     *
     * php artisan column:cache
     * php artisan column:blade
     *
     * or
     * open tinker and run:
     * ( new \App\Http\Controllers\Staticizer)->useColumnsData();
     */
    function useColumnsData($method = null, ...$params)
    {

        if ($method) {
            $this->$method(...$params);
            return;
        }

        $this->_makeColumnsCache();

        \File::deleteDirectory(base_path() . '/resources/views/partials/columns');
        \File::deleteDirectory(base_path() . '/resources/views/layouts/columns');

        $this->partial('columns.navbar-nav-left', [], 'columns._navbar-nav-left');
        $this->partial('columns.map', [], 'columns._map');
        $this->_columnsSelect(2); // 2 is the id of shanshui column
        $this->_columnsHome();


    }

    protected function viewFromTo($viewName, $data = array(), $newName = null, $echoBlade = false)
    {
        $oView = view('_s.' . $viewName, $data);

        try {
            $r = $oView->render();
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

    protected function header($data = array())
    {
        return $this->sanitize_output(
            $this->viewFromTo('partials.columns.header', $data,null, true));
    }

    function sanitize_output($buffer)
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


    /**
     * open tinker and run:
     * ( new \App\Http\Controllers\Staticizer)->createFinanceData();
     */
    function createFinanceData()
    {
        $data['financeRecords'] = \App\FinanceRecord::getLast();
        $this->partial('country.finance', $data, 'country._finance');
    }


    protected function _makeColumnsCache()
    {
        $file = storage_path() . '/cache/columns.php';
        file_put_contents($file, '<?'
            . 'php const MENU_ITEMS = '
            . var_export(MenuItemHelper::getMenuItemsInfo(0), true)
            . '   ; ?>'
        );

        $headers = $this->_columnsOthers('pass')
            + $this->_columnsLayouts($this->topItemId['main'])//        + $this->_columnsOthers('game')
        ;

        $headers[0] = <<<HOMEPAGE
<div class="row" id="header-row"><div class="col-xs-4"><h1 id="header-name"><a href="/">真城</a></h1></div>
<div class="col-xs-8"><ul class="nav nav-pills pull-right" id="header-nav"><li role="presentation"><a href="/green">山青</a></li><li role="presentation"><a href="/human/road">人之路</a></li><li role="presentation"><a href="/sail">越海</a></li></ul></div></div>
HOMEPAGE;


        $file = storage_path() . '/cache/headers.php';
        file_put_contents($file, '<?'
            . 'php const ZC_HEADERS = '
            . var_export($headers, true)
            . '   ; ?>'
        );

    }

    // html select : <select></select>
    protected function _columnsSelect($level1id)
    {
        echo "### start <select> opt \n";
        $this->partial('columns.select_column_under_a_level1', compact('level1id'), 'columns._select_opt_shanshui');
    }

    protected function _columnsHome()
    {
        // ### home
        echo "### start home\n";
        $ids = DB::table('menu_items')->whereIn('name', ['真山', '人山'])->pluck('id');
        $this->partial('columns.home-body', compact('ids'), 'columns._home-body');
    }

    protected function _columnsLayouts($topId)
    {
        echo "### start main menu header\n";

        $header = [];

        $columns = $this->columns;

        foreach ($columns[$topId]->children as $level1id) {
            $level1 = $columns[$level1id];
            echo " level-1 {$level1->name} $level1id \n";
            if ($level1->children) {
                foreach ($level1->children as $level2id) {
                    $level2 = $columns[$level2id];

                    $header_intro = $level2->name === '越海' ? '开拓人类之路' : null;

                    echo "    level-2 {$level2->name}  $level2id:\n";
                    $header[$level2id] = $this->header(['leftColumn' => $level2, 'title' => ($level2->name) . ' &nbsp;|&nbsp; 真城', 'header_intro' => $header_intro]);

                    // a simple title for article
                    if ($level2->name == '书架' || $level2->name == '视窗') {
                        $header[$level2id] = $this->header(['leftColumn' => $level2, 'title' => '真城' . ($level2->name)]);
                    }


                    if ($level2->children) {
                        foreach ($level2->children as $level3id) {
                            $level3 = $columns[$level3id];
                            echo "      level-3 {$level3->name } $level3id\n";
                            // title 显示$level2的名字
                            $header[$level3id] = $this->header(['leftColumn' => $level2, 'activeId' => $level3id, 'title' => ($level3->name) . ' &nbsp;|&nbsp; 真城' . $level2->name, 'header_intro' => $header_intro]);


                        }
                    }
                }
            }
        }

        return $header;
    }

    protected function _columnsOthers($menuUrlPrefix)
    {
        if (!isset($this->menuId[$menuUrlPrefix])) {
            echo 'wrong for  menu url-prefix : ', $menuUrlPrefix;
            return;
        }

        echo "### start $menuUrlPrefix header\n";

        $header = [];

        $leftColumnId = $this->topItemId[$menuUrlPrefix];
        $leftColumn = $this->columns[$leftColumnId];
        $title = $leftColumn->name;
        $header[$leftColumnId] = $this->header(compact('leftColumn', 'title'));
        foreach ($leftColumn->children as $activeId) {
            $activeColumn = $this->columns[$activeId];
            $title = $activeColumn->name;
            $header[$activeId] = $this->header(compact('leftColumn', 'activeId', 'title'));
        }

        return $header;
    }


}