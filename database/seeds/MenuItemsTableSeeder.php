<?php
/**
 * php artisan db:seed --class=MenuItemsTableSeeder
 */
use Illuminate\Database\Seeder;


class MenuItemsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('menu_items')->truncate();

        $main_menu = [
            ['name' => '网站主栏目', 'show'=>true,'short_name' => null, 'css' => null, 'type' => 'box', 'level' => 0, 'order' => 1, 'url' => '', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => '', '_children' => [

                ['name' => '山水', 'show'=>true,'short_name' => null, 'css' => null, 'type' => 'box', 'level' => 1, 'order' => 1, 'url' => '/civilisation', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => '', '_children' => [

                    ['name' => '真山', 'show'=>true,'short_name' => null, 'css' => null, 'type' => 'box', 'level' => 2, 'order' => 1, 'url' => '/zhen', 'ctitle'=>'','title'=>'真山 &nbsp;|&nbsp; 真城', 'desc' => '人真如山', 'pic' => '', '_children' => [

                        ['name' => '山青', 'show'=>true,'short_name' => '人', 'css' => '2', 'type' => 'article', 'level' => 3, 'order' => 1, 'url' => '/green', 'ctitle'=>'山青 &nbsp;|&nbsp; 真城','title'=>'山青 &nbsp;|&nbsp; 真城', 'desc' => '青泉到海流不息', 'pic' => 'qing.jpg'],
                        ['name' => '真意', 'show'=>true,'short_name' => '意', 'css' => '3', 'type' => 'quote', 'level' => 3, 'order' => 2, 'url' => '/spirit',  'ctitle'=>'真意 &nbsp;|&nbsp; 真城','title'=>'真意 &nbsp;|&nbsp; 真城', 'desc' => '此中有真意', 'pic' => 'aboutme.jpg'],
                        ['name' => '山书', 'show'=>true,'short_name' => '书', 'css' => '1', 'type' => 'article', 'level' => 3, 'order' => 3, 'url' => '/paper', 'ctitle'=>'山书 &nbsp;|&nbsp; 真城','title'=>'山书 &nbsp;|&nbsp; 真城', 'desc' => '岭上多白云', 'pic' => 'book.jpg',],
//                        ['name' => '海贝', 'show'=>true,'short_name' => '海', 'css' => 'q', 'type' => 'quote', 'level' => 3, 'order' => 3, 'url' => '/shells', 'ctitle'=>'海贝 &nbsp;|&nbsp; 真城','title'=>'海贝 &nbsp;|&nbsp; 真城', 'desc' => '明月共潮生', 'pic' => 'seashell.jpg'],
                    ]],
                    ['name' => '人山', 'show'=>true,'short_name' => null, 'css' => null, 'type' => 'box', 'level' => 2, 'order' => 2, 'url' => '/human', 'ctitle'=>'','title'=>'人山 &nbsp;|&nbsp; 真城', 'desc' => '人如山立', 'pic' => '', '_children' => [

                        ['name' => '天性', 'show'=>true,'short_name' => '人', 'css' => '2', 'type' => 'article', 'level' => 3, 'order' => 1, 'url' => '/human/nature', 'ctitle'=>'天性 &nbsp;|&nbsp; 真城','title'=>'天性 &nbsp;|&nbsp; 真城', 'desc' => '人性，物性，神性', 'pic' => 'nature.jpg'],
                        ['name' => '人路', 'show'=>true,'short_name' => '路', 'css' => '1', 'type' => 'article', 'level' => 3, 'order' => 2, 'url' => '/human/road', 'ctitle'=>'人路 &nbsp;|&nbsp; 真城','title'=>'人也 &nbsp;|&nbsp; 真城', 'desc' => '成为人', 'pic' => 'road.jpg'],
                        ['name' => '这样', 'show'=>true,'short_name' => '地', 'css' => 'q', 'type' => 'quote', 'level' => 3, 'order' => 3, 'url' => '/human/so', 'ctitle'=>'天地 &nbsp;|&nbsp; 真城','title'=>'这样 &nbsp;|&nbsp; 真城', 'desc' => '天，地', 'pic' => 'disaster.jpg'],
                        ['name' => '个体', 'show'=>true,'short_name' => '地', 'css' => 'q', 'type' => 'quote', 'level' => 3, 'order' => 4, 'url' => '/human/indiv', 'ctitle'=>'天地 &nbsp;|&nbsp; 真城','title'=>'个体 &nbsp;|&nbsp; 真城', 'desc' => '天地，人', 'pic' => 'disaster.jpg'],
//                ['name' => '人难',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 3, 'order' => 5,  'url' => '/human/disaster', 'ctitle'=>'','title'=>'', 'desc' => '不敢遗忘', 'pic' => 'disaster.jpg',],
                    ]],
                    // 人类文明发端于两河，人类也如河流一般奔腾、交汇
                    // 远行 远帆 蹈海 渡海
                    ['name' => '越海', 'show'=>true,'short_name' => null, 'css' => null, 'type' => 'box', 'level' => 2, 'order' => 4, 'url' => '/sail', 'ctitle'=>'越海 &nbsp;|&nbsp; 真城','title'=>'越海 &nbsp;|&nbsp; 真城', 'desc' => '人类之路，人类之路的开路人、领路者', 'pic' => '', '_children' => [

                        ['name' => '行者', 'show'=>true,'short_name' => '人', 'css' => '1', 'type' => 'quote', 'level' => 3, 'order' => 1, 'url' => '/sail/walkers', 'ctitle'=>'','title'=>'行者 &nbsp;|&nbsp; 越海', 'desc' => '从远方而来，向远方而去', 'pic' => null],
                        ['name' => '财艺', 'show'=>true,'short_name' => '财', 'css' => '2', 'type' => 'quote', 'level' => 3, 'order' => 2, 'url' => '/sail/assets', 'ctitle'=>'','title'=>'财艺 &nbsp;|&nbsp; 越海', 'desc' => '我们坐享着几千年的财富。', 'pic' => null],
                        ['name' => '知道', 'show'=>true,'short_name' => '道', 'css' => 'q', 'type' => 'quote', 'level' => 3, 'order' => 3, 'url' => '/sail/road', 'ctitle'=>'','title'=>'知道 &nbsp;|&nbsp; 越海', 'desc' => '人之知，行之道。', 'pic' => null],
                        // 治变 治权 治化 辖治
//            ['name' => '辖治',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 3, 'order' => 4,  'url' => '/sail/zhi', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => null],
                    ]],
                    // url: with or one
//            ['id' => $ID['gong_he'],  'name' => '共河',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 2, 'order' => 4,  'url' => '/gong', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
//            ['id' => $ID['sheng_he'],  'name' => '生河',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 2, 'order' => 5,  'url' => '/sheng', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
                ]],
                // 'url'=>'/culture'
                ['name' => '人文', 'show'=>true,'short_name' => null, 'css' => null, 'type' => 'box', 'level' => 1, 'order' => 2, 'url' => '/library', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => '', '_children' => [
                    ['name' => '书架', 'show'=>true,'short_name' => null, 'css' => null, 'type' => null, 'level' => 2, 'order' => 1, 'url' => '/book', 'ctitle'=>'真城书架','title'=>'书架 &nbsp;|&nbsp; 真城', 'desc' => '书籍是我们的心灵。', 'pic' => ''],
                    ['name' => '视窗', 'show'=>true,'short_name' => null, 'css' => null, 'type' => null, 'level' => 2, 'order' => 2, 'url' => '/video', 'ctitle'=>'真城视窗','title'=>'视窗 &nbsp;|&nbsp; 真城', 'desc' => '心灵的影视世界。', 'pic' => ''],
                    //['name' => '诗抄存', 'show'=>true,'short_name' => null,  'css' => null, 'type' => null, 'level' => 2, 'order' => 3, 'url' => '/poem', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
                    //['name' => '趣拾', 'show'=>true,'short_name' => null,  'css' => null, 'type' => null, 'level' => 2, 'order' => 4, 'url' => '/fun', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],

                ]],
                // 'url'=>'/community'
                ['name' => '山脚下', 'show'=>true,'short_name' => null, 'css' => null, 'type' => 'box', 'level' => 1, 'order' => 3, 'url' => '/country', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => '', "_children" => [
                    //['name' => '忆少年', 'show'=>true,'short_name' => null,  'css' => null, 'type' => null, 'level' => 2, 'order' => 1, 'url' => '/home/qing', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
                    //['name' => '留人书', 'show'=>true,'short_name' => null,  'css' => null, 'type' => null, 'level' => 2, 'order' => 2, 'url' => '/country/book', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
                    // 石头记/ 天行健 六志 人志 人记
                    // 如果书籍、影视需要搜罗万象，而书架、视窗满足不了，则可改名为“百科”
                    //['name' => '人物表', 'show'=>true,'short_name' => null,  'css' => null, 'type' => null, 'level' => 2, 'order' => 3, 'url' => '/country/people', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
//                    ['name' => '淡水湾', 'show'=>true,'short_name' => null, 'css' => null, 'type' => null, 'level' => 2, 'order' => 5, 'url' => '/bay', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
                    ['name' => '三角树', 'show'=>true,'short_name' => null, 'css' => null, 'type' => null, 'level' => 2, 'order' => 7, 'url' => '/tree', 'ctitle'=>'','title'=>'真城三角树', 'desc' => '真城式黄页，商业名录。', 'pic' => ''],
                    // 城务站
                    ['name' => '市政厅', 'show'=>true,'short_name' => null, 'css' => null, 'type' => null, 'level' => 2, 'order' => 7, 'url' => '/hall', 'ctitle'=>'','title'=>'真城市政厅', 'desc' => '真城的财政、组织。', 'pic' => ''],
                ]],
                //['name' => '游戏',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 1, 'order' => 4,  'url' => '/games', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
            ]
            ],

        ];

//        DB::table('menu_items')->insert([
        //['name' => '坐下来',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>null,'level' => 2, 'order' => 1,  'url' => '/game/sit', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
        //['name' => '假设',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>null,'level' => 2, 'order' => 2,  'url' => '/game/suppose', 'ctitle'=>'','title'=>'', 'desc' => '', 'pic' => ''],
//        ]);

        $this->insertColumns($main_menu);

        $yilu_menu_id = 2;

        $yilu_menu = [
            // mountain pass
            ['menu_id' => $yilu_menu_id, 'name' => '山关', 'show'=>true,'short_name' => null, 'css' => null, 'type' => null, 'level' => 0, 'order' => 1, 'url' => '/pass',
                'ctitle'=>'','title'=>'真城山关','desc'=>'真城山关',
                '_children' => [
                    ['menu_id' => $yilu_menu_id, 'name' => '渡口', 'show'=>true,'short_name' => null, 'css' => null, 'type' => null, 'level' => 1, 'order' => 2, 'url' => '/ferry'
                ,'ctitle'=>'','title'=>'真城渡口','desc'=>'从这里，到真城',
                    ],
                    // newspeak town 新话镇
//                    ['menu_id' => $yilu_menu_id, 'name' => '假雨村', 'show'=>true,'short_name' => null,  'css' => null, 'type' => null, 'level' => 1, 'order' => 2, 'url' => '/newspeak'],
//            ['menu_id' => $yilu_menu_id, 'name' => '真城',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>null,'level' => 1, 'order' => 3,  'url' => '/gate/about'],
//            ['menu_id' => $yilu_menu_id, 'name' => '规则',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>null,'level' => 1, 'order' => 5,  'url' => '/gate/rules'],

                ]]
        ];
//        $matou_id = DB::table('menu_items')->where('name','=','浊水码头')->first()->id;
//        DB::table('menu_items')->insert([
//            [ 'name' => '河船',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>null,'level' => 3, 'order' => 1,  'url' => '/country/riverboats'],
//            [ 'name' => '海船',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>null,'level' => 3, 'order' => 2,  'url' => '/country/seaboats'],
//        ]);

        $this->insertColumns($yilu_menu);

        (new \App\Http\Controllers\Staticizer)->useColumnsData();


    }

    protected function insertColumns(array $columns, $pid = null)
    {
        foreach ($columns as $column) {
            $children = null;
            if (isset($column['_children'])) {
                $children = $column['_children'];
                unset($column['_children']);
            }

            if ($pid) $column['pid'] = $pid;

            $id = DB::table('menu_items')->insertGetId($column);
            echo "{$column['name']}: $id\n";

            if ($children) {
                $this->insertColumns($children, $id);
            }
        }
    }

}
