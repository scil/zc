<?php

namespace App\Services;

use App\Column;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * only return infos
 * @package App\Services
 */
class MenuItemHelper //  extends Model
{
    static protected $topMenuItemIds = [];

    static protected $all_items_with_id_as_key = [];

    static protected $urlMapId = [];

    static protected $menu_items_info_with_MenuId__Locale_Url_as_Key = [];

    static function getTopItemId($menuId = 1)
    {
        if (isset(self::$topMenuItemIds[$menuId]))
            return self::$topMenuItemIds[$menuId];

        $item = DB::table('menu_items')
            ->where('level', 0)
            ->where('menu_id', $menuId)
            ->first();

        if ($item) {
            $id = $item->id;
            self::$topMenuItemIds[$menuId] = $id;
            return $id;
        } else {
            throw new \Exception("No menu found for menu id $menuId");
        }
    }

    /**
     * return current locale info of menu items in a menu or in all menus
     * also produce $menuItemsInfoWithMenuIdAndUrlAsKey for menu $menuId
     *
    /* for share var COLUMNS_INFO in resources/view/_s/partials/columns/*.blade.php,
     *
    /* id as key
    /*
    /* value is instance of Mode which uses laravel-translatable, and plus props children and names
     *
     * @param int $menuId return all items if menuId ==0
     */
    static function getAllItemObjectsById($menuId = 0)
    {

        if (isset(self::$all_items_with_id_as_key[$menuId]))
            return self::$all_items_with_id_as_key[$menuId];

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


        $all_with_id_as_key = [];
        foreach ($all as $item) {

            // instance of Mode which uses laravel-translatable
            $objItem = Column::where('id', $item->id)->first();

            // add a new prop
            $objItem->children = $item->children ? explode(',', $item->children) : null;

            // add a new prop `names` ,only for demo_select_lang
            $localsInfo = $objItem->getTranslationsArray();
            $names = [];
            foreach ($localsInfo as $locale=> $oneLocalInfo )
            {
                $names[$locale]=$oneLocalInfo['name'];
            }
            $objItem->names = json_encode($names);

            //var_dump($objItem->names);exit();

            $all_with_id_as_key[$item->id] = $objItem;
        }

        $localeBackup = app()->getLocale();
        echo "current locale: $localeBackup ", __FILE__, PHP_EOL;

        self::$menu_items_info_with_MenuId__Locale_Url_as_Key[$menuId] = [];
        static::$urlMapId[$menuId] = [];

        foreach (ALL_LOCALS as $locale) {
            app()->setLocale($locale);
            self::$menu_items_info_with_MenuId__Locale_Url_as_Key[$menuId][$locale] = [];

            foreach ($all_with_id_as_key as $item) {
                // $key= $item->id;
                $key = substr($item->url, 1);

                static::$urlMapId[$menuId][$key] = ['id' => $item->id];

                if ($item->css)
                    static::$urlMapId[$menuId][$key]['css'] = $item->css;

                $var = &self::$menu_items_info_with_MenuId__Locale_Url_as_Key[$menuId][$locale][$key];

                $var['id'] = $item->id;
                if ($item->name)
                    $var['name'] = $item->name;
                if ($item->short_name)
                    $var['short_name'] = $item->short_name;
                if ($item->desc)
                    $var['desc'] = $item->desc;
                if ($item->title)
                    $var['title'] = $item->title;
                if ($item->ctitle)
                    $var['ctitle'] = $item->ctitle;

                if ($item->level == 2) {
                    $level2 = $item;

                    if ($level2->children) {

                        static::$urlMapId[$menuId][$key]['a'] = [];
                        static::$urlMapId[$menuId][$key]['q'] = [];

                        foreach ($level2->children as $child_id) {
                            if (!isset($all_with_id_as_key[$child_id]))
                                continue;
                            $level3 = $all_with_id_as_key[$child_id];

                            if ($level3->type === 'article')
                                static::$urlMapId[$menuId][$key]['a'][] = $level3->id;

                            if ($level3->type === 'quote')
                                static::$urlMapId[$menuId][$key]['q'][] = $level3->id;
                        }
                    }
                }
            }
        }

        app()->setLocale($localeBackup);

//        var_dump(self::$level2ParentAndChildrenMapByType);
        return self::$all_items_with_id_as_key[$menuId] = $all_with_id_as_key;

    }


    // menuId and url as key
    // include info from  'menu_item_translations'
    // key 0 indicates all menus
    //
    // for  bootstrap/cache2/menu_items.php
    static function getMenuItemsInfo($menuId = 0)
    {
        return self::$menu_items_info_with_MenuId__Locale_Url_as_Key[$menuId];
    }

    static function getUrlMapId($menuId = 0)
    {
        return static::$urlMapId[$menuId];
    }

}
