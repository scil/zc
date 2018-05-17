<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class MenuItemHelper //  extends Model
{
    static protected $allItemsById = [];
    static protected $topItemIds = [];
    static protected $menuItemsInfo = [];

    static function getTopItemId($menuId = 1)
    {
        if (isset(self::$topItemIds[$menuId]))
            return self::$topItemIds[$menuId];

        $id = DB::table('menu_items')
            ->where('level', 0)
            ->where('menu_id', $menuId)
            ->first()->id;
        self::$topItemIds[$menuId] = $id;
        return $id;
    }

    /**
     * @param menuId    get all items if menuId ==0
     */
    static function getAllItems($menuId = 0)
    {

        if (isset(self::$allItemsById[$menuId]))
            return self::$allItemsById[$menuId];

        if ($menuId > 0) {

            // 每个item增加了一个字段'children' 里面是其所有子元素的id
            // 第一个查询 查询出了所有有子元素的元素；第二个查询 查询出没有子元素的元素,为保证union顺利进行，增加了一个字段 ifnull(null,null) as children
            $q = ' (select m1.* , group_concat(m2.id order by m2.order) children from menu_items m1, menu_items m2 where m1.menu_id= ? and m2.menu_id= ?  and m1.id = m2.pid  group by m2.pid )
union 
( select m1.* ,ifnull(null, null ) as children  from menu_items m1 where m1.menu_id= ?  and not exists ( select * from menu_items m2 where m2.menu_id= ? and m1.id=m2.pid ) ) ';
            $all = DB::select($q, [$menuId, $menuId, $menuId, $menuId]);
        } elseif ($menuId == 0) {

            $q = ' (select m1.* , group_concat(m2.id order by m2.order) children from menu_items m1, menu_items m2 where m1.menu_id=  m2.menu_id   and m1.id = m2.pid  group by m2.pid )
union 
( select m1.* ,ifnull(null, null ) as children  from menu_items m1 where not exists ( select * from menu_items m2 where m1.menu_id = m2.menu_id and m1.id=m2.pid ) ) ';
            $all = DB::select($q);
        }


        $allById = [];
        foreach ($all as $item) {
            $allById[$item->id] = $item;
            $allById[$item->id]->children = $item->children ? explode(',', $item->children) : null;
        }

        self::$menuItemsInfo[$menuId] = [];
        foreach ($all as $item) {
//            $key= $item->id;
            $key = substr($item->url, 1);
            self::$menuItemsInfo[$menuId][$key]['id'] = $item->id;
            if ($item->name)
                self::$menuItemsInfo[$menuId][$key]['name'] = $item->name;
            if ($item->short_name)
                self::$menuItemsInfo[$menuId][$key]['short_name'] = $item->short_name;
            if ($item->css)
                self::$menuItemsInfo[$menuId][$key]['css'] = $item->css;
            if ($item->desc)
                self::$menuItemsInfo[$menuId][$key]['desc'] = $item->desc;
            if ($item->title)
                self::$menuItemsInfo[$menuId][$key]['title'] = $item->title;
            if ($item->ctitle)
                self::$menuItemsInfo[$menuId][$key]['ctitle'] = $item->ctitle;

            if ($item->level == 2) {
                $level2 = $item;

                if ($level2->children) {

                    self::$menuItemsInfo[$menuId][$key]['a'] = [];
                    self::$menuItemsInfo[$menuId][$key]['q'] = [];

                    foreach ($level2->children as $child_id) {
                        if (!isset($allById[$child_id]))
                            continue;
                        $level3 = $allById[$child_id];
                        $level3_key = substr($level3->url, 1);

                        if ($level3->type == 'article')
                            array_push(self::$menuItemsInfo[$menuId][$key]['a'], $level3->id);
                        if ($level3->type == 'quote')
                            array_push(self::$menuItemsInfo[$menuId][$key]['q'], $level3->id);
                    }
                }
            }
        }
//        var_dump(self::$level2ParentAndChildrenMapByType);
        return self::$allItemsById[$menuId] = $allById;

    }


    static function getMenuItemsInfo($menuId = 0)
    {
        return self::$menuItemsInfo[$menuId];
    }


}
