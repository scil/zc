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

    protected function layout($viewName, $data = array(), $newName = null)
    {
        return $this->viewFromTo('layouts.' . $viewName, $data, is_null($newName) ? null : 'layouts.' . $newName, true);
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

    /**
     *
     * php artisan column:cache
     *
     * or
     * open tinker and run:
     * ( new \App\Http\Controllers\Staticizer)->createColumnsData();
     */
    function createColumnsData($method = null, ...$params)
    {
        $this->_initColumnsData();

        if ($method) {
            $this->$method(...$params);
            return;
        }

        \File::deleteDirectory(base_path() . '/resources/views/partials/columns');
        \File::deleteDirectory(base_path() . '/resources/views/layouts/columns');

        $this->_makeColumnsCache();

        $this->partial('columns.navbar-nav-left', [], 'columns._navbar-nav-left');
        $this->partial('columns.map', [], 'columns._map');
        $this->_columnsSelect(2); // 2 is the id of shanshui column
        $this->_columnsHome();
        $this->_columnsLayouts($this->topItemId['main']);
        $this->_columnsOne();
//        $this->_columnsGame();

    }

    protected function _initColumnsData()
    {
        foreach ($this->menuId as $name => $id) {
            $this->topItemId[$name] = MenuItemHelper::getTopItemId($id);
        }

        $this->columns = view()->share('columns', MenuItemHelper::getAllItems());

        view()->share('topId', $this->topItemId['main']);

        if (isset($this->topItemId['game']))
            view()->share('gameTopId', $this->topItemId['game']);

    }

    protected function _makeColumnsCache()
    {
        $file = storage_path() . '/staticizer/columns.php';
        file_put_contents($file, '<?'
            . 'php const MENU_ITEMS = '
            . var_export(MenuItemHelper::getMenuItemsInfo(0), true)
            . '   ; ?>'
        );
    }
//                var_export([
//                MenuItemHelper::getUrlIdMap(),
//                MenuItemHelper::getMenuItemsInfo(0),
////                MenuItemHelper::getParentChildren(0),
//            ], true)

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

        $columns = $this->columns;

        foreach ($columns[$topId]->children as $level1id) {
            $level1 = $columns[$level1id];
            echo " level-1 {$level1->name} $level1id \n";
            if ($level1->children) {
                foreach ($level1->children as $level2id) {
                    $level2 = $columns[$level2id];

                    echo "    level-2 {$level2->name}  $level2id:\n";
                    $this->layout('column', ['leftColumn' => $level2, 'title' => ($level2->name) . ' &nbsp;|&nbsp; 真城'], 'columns._' . $level2id);

                    // a simple title for article
                    if($level2->name=='书架'||$level2->name=='视窗'){
                        $this->layout('column', ['leftColumn' => $level2, 'title' => '真城'.($level2->name)], 'columns.__' . $level2id);

                    }

                    if ($level2->children) {
                        foreach ($level2->children as $level3id) {
                            $level3 = $columns[$level3id];
                            echo "      level-3 {$level3->name } $level3id\n";
                            // title 显示$level2的名字
                            $this->layout('column', ['leftColumn' => $level2, 'activeId' => $level3id, 'title' => ($level3->name) . ' &nbsp;|&nbsp; 真城'.$level2->name], 'columns._' . $level3id);


                        }
                    }
                }
            }
        }
    }

    protected function _columnsOne()
    {
        $this->__columnsOthers('pass');
    }

    protected function _columnsGame()
    {
        $this->__columnsOthers('game');
    }

    protected function __columnsOthers($menuUrlPrefix)
    {
        if (!isset($this->menuId[$menuUrlPrefix])) {
            echo 'wrong for  menu url-prefix : ', $menuUrlPrefix;
            return;
        }

        echo "### start $menuUrlPrefix header\n";

        $leftColumnId = $this->topItemId[$menuUrlPrefix];
        $leftColumn = $this->columns[$leftColumnId];
        $title = $leftColumn->name;
        $this->layout('column', compact('leftColumn', 'title'), 'columns._' . $menuUrlPrefix);
        foreach ($leftColumn->children as $activeId) {
            $activeColumn = $this->columns[$activeId];
            $title = $activeColumn->name;
            $this->layout('column', compact('leftColumn', 'activeId', 'title'), 'columns.' . str_replace('/', '_', $activeColumn->url));
        }
    }


}