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
        DB::table('menu_item_translations')->truncate();

        $main_menu = [
            ['show' => true, 'css' => null, 'type' => 'box', 'level' => 0, 'order' => 1,
                '_trans' => [
                    'zh' => ['name' => '网站主栏目',],
                    'en' => ['name' => 'main',]
                ], '_children' => [

                ['show' => true, 'css' => null, 'type' => 'box', 'level' => 1, 'order' => 1, 'url' => '/civilisation', '_trans' => [
                    'zh' => ['name' => '山水',],
                    'en' => ['name' => 'Gaia',]
                ], '_children' => [

                    ['show' => true, 'css' => null, 'type' => 'box', 'level' => 2, 'order' => 1, 'url' => '/zhen', '_trans' => [
                        'zh' => ['name' => '真山', 'title' => '真山 &nbsp;|&nbsp; 真城', 'desc' => '人真如山',],
                        'en' => ['name' => 'Zhen Hills', 'title' => 'Zhen Hills &nbsp;|&nbsp; Zhen City', 'desc' => 'Zhen in human nature is like a standing hill.',],
                    ], '_children' => [

                        ['show' => true, 'css' => '2', 'type' => 'article', 'level' => 3, 'order' => 1, 'url' => '/children', 'pic' => 'qing.jpg', '_trans' => [
                            'zh' => ['name' => '真之子', 'short_name' => '子', 'ctitle' => '真之子 &nbsp;|&nbsp; 真城', 'title' => '真之子 &nbsp;|&nbsp; 真城', 'desc' => '高山仰止,虽不能至,然心向往之',],
                            'en' => ['name' => 'Children', 'short_name' => 'C', 'ctitle' => 'Children of Zhen &nbsp;|&nbsp; Zhen City', 'title' => 'Children of Zhen &nbsp;|&nbsp; Zhen City', 'desc' => 'Children of Zhen',],
                        ]],
                        ['show' => true, 'css' => '3', 'type' => 'quote', 'level' => 3, 'order' => 2, 'url' => '/sky', 'pic' => 'aboutme.jpg', '_trans' => [
                            'zh' => ['name' => '真意', 'short_name' => '意', 'ctitle' => '真意 &nbsp;|&nbsp; 真城', 'title' => '真意 &nbsp;|&nbsp; 真城', 'desc' => '此中有真意',],
                            'en' => ['name' => 'Starry Sky', 'short_name' => 'S', 'ctitle' => 'Starry Sky &nbsp;|&nbsp; Zhen City', 'title' => 'Starry Sky &nbsp;|&nbsp; Zhen City', 'desc' => 'The starry sky Zhen lives under and appreciates',],
                        ]
                        ],
                        ['show' => true, 'css' => '1', 'type' => 'article', 'level' => 3, 'order' => 3, 'url' => '/think', 'pic' => 'book.jpg', '_trans' => [
                            'zh' => ['name' => '山书', 'short_name' => '书', 'ctitle' => '山书 &nbsp;|&nbsp; 真城', 'title' => '山书 &nbsp;|&nbsp; 真城', 'desc' => '岭上多白云',],
                            'en' => ['name' => 'Think', 'short_name' => 'T', 'ctitle' => 'Think &nbsp;|&nbsp; Zhen City', 'title' => 'Think &nbsp;|&nbsp; Zhen City', 'desc' => 'TO KNOW, TO MOVE',],
                        ],],
//                        ['name' => '海贝', 'show'=>true,'short_name' => '海', 'css' => 'q', 'type' => 'quote', 'level' => 3, 'order' => 3, 'url' => '/shells', 'ctitle'=>'海贝 &nbsp;|&nbsp; 真城','title'=>'海贝 &nbsp;|&nbsp; 真城', 'desc' => '明月共潮生', 'show_pic'=>false,'pic'=>'seashell.jpg', '_trans'=>['zh'=>[]]],
                    ]],
                    ['show' => true, 'css' => null, 'type' => 'box', 'level' => 2, 'order' => 2, 'url' => '/human', '_trans' => [
                        'zh' => ['name' => '人山', 'title' => '人山 &nbsp;|&nbsp; 真城', 'desc' => '人如山立',],
                        'en' => ['name' => 'Human Hills', 'title' => 'Human Hills &nbsp;|&nbsp; Zhen City', 'desc' => 'A person is like a standing hill.',],
                    ], '_children' => [

                        ['show' => true, 'css' => '2', 'type' => 'article', 'level' => 3, 'order' => 1, 'url' => '/human/nature', 'pic' => 'nature.jpg', '_trans' => [
                            'zh' => ['name' => '天性', 'short_name' => '人', 'ctitle' => '天性 &nbsp;|&nbsp; 真城', 'title' => '天性 &nbsp;|&nbsp; 真城', 'desc' => '天性，物性，神性',],
                            'en' => ['name' => 'Nature', 'short_name' => 'N', 'ctitle' => 'Human Nature &nbsp;|&nbsp; Zhen City', 'title' => 'Human Nature &nbsp;|&nbsp; Zhen City', 'desc' => 'BY NATURE, FROM NATURE',],
                        ]
                        ],
                        ['show' => true, 'css' => '1', 'type' => 'article', 'level' => 3, 'order' => 2, 'url' => '/human/road', 'pic' => 'road.jpg', '_trans' => [
                            'zh' => ['name' => '人之路', 'short_name' => '路', 'ctitle' => '人路 &nbsp;|&nbsp; 真城', 'title' => '人之路 &nbsp;|&nbsp; 真城', 'desc' => '成为人',],
                            'en' => ['name' => 'Road', 'short_name' => 'R', 'ctitle' => 'Human Road &nbsp;|&nbsp; Zhen City', 'title' => 'Human Road &nbsp;|&nbsp; Zhen City', 'desc' => 'TO BE HUMAN',],
                        ]],
                        ['show' => true, 'css' => 'q', 'type' => 'quote', 'level' => 3, 'order' => 3, 'url' => '/human/country', 'pic' => 'disaster.jpg', '_trans' => [
                            'zh' => ['name' => '人天地', 'short_name' => '这', 'ctitle' => '人天地 &nbsp;|&nbsp; 真城', 'title' => '人天地 &nbsp;|&nbsp; 真城', 'desc' => '天，地'],
                            'en' => ['name' => 'Country', 'short_name' => 'C', 'ctitle' => 'Human Country &nbsp;|&nbsp; Zhen City', 'title' => 'Human Country &nbsp;|&nbsp; Zhen City', 'desc' => 'LIVING IN',],
                        ]],
                        ['show' => true, 'css' => 'q', 'type' => 'quote', 'level' => 3, 'order' => 4, 'url' => '/human/Indiv', 'pic' => 'disaster.jpg', '_trans' => [
                            'zh' => ['name' => '个体树', 'short_name' => '个', 'ctitle' => '个体树 &nbsp;|&nbsp; 真城', 'title' => '个体树 &nbsp;|&nbsp; 真城', 'desc' => '天地，人'],
                            'en' => ['name' => 'Individual', 'short_name' => 'I', 'ctitle' => 'Human Individual &nbsp;|&nbsp; Zhen City', 'title' => 'Human Individual &nbsp;|&nbsp; Zhen City', 'desc' => 'INDIV TREES',],
                        ]],
//                ['name' => '人难',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 3, 'order' => 5,  'url' => '/human/disaster', 'ctitle'=>'','title'=>'', 'desc' => '不敢遗忘', 'show_pic'=>false,'pic'=>'disaster.jpg', '_trans'=>['zh'=>[]],],
                    ]],
                    // 人类文明发端于两河，人类也如河流一般奔腾、交汇
                    // 远行 远帆 蹈海 渡海
                    ['show' => true, 'css' => null, 'type' => 'box', 'level' => 2, 'order' => 4, 'url' => '/sail', '_trans' => [
                        'zh' => ['name' => '越海', 'ctitle' => '越海 &nbsp;|&nbsp; 真城', 'title' => '越海 &nbsp;|&nbsp; 真城', 'desc' => '人类之路，人类之路的开路人、带路者'],
                        'en' => ['name' => 'Sailing', 'ctitle' => 'Sailing &nbsp;|&nbsp; Zhen City', 'title' => 'Sailing &nbsp;|&nbsp; Zhen City', 'desc' => 'Advance in Civilization Road.'],
                    ], '_children' => [

                        ['show' => true, 'css' => '1', 'type' => 'quote', 'level' => 3, 'order' => 1, 'url' => '/sail/walkers', 'pic' => null, '_trans' => [
                            'zh' => ['name' => '行者', 'short_name' => '人', 'title' => '行者 &nbsp;|&nbsp; 越海', 'desc' => '从远方而来，向远方而去'],
                            'en' => ['name' => 'Walkers', 'short_name' => 'P', 'title' => 'Walkers &nbsp;|&nbsp; Sailing', 'desc' => 'from afar'],
                        ]],
                        ['show' => true, 'css' => 'q', 'type' => 'quote', 'level' => 3, 'order' => 2, 'url' => '/sail/road', 'pic' => null, '_trans' => [
                            'zh' => ['name' => '知道', 'short_name' => '道', 'title' => '知道 &nbsp;|&nbsp; 越海', 'desc' => '认知之途，行进之路。'],
                            'en' => ['name' => 'Road', 'short_name' => 'R', 'title' => 'Road &nbsp;|&nbsp; Sailing', 'desc' => 'The path human beings think, the way human beings walk.'],
                        ]],
                        ['show' => true, 'css' => '2', 'type' => 'quote', 'level' => 3, 'order' => 3, 'url' => '/sail/wealth', 'pic' => null, '_trans' => [
                            'zh' => ['name' => '财艺', 'short_name' => '财', 'title' => '财艺 &nbsp;|&nbsp; 越海', 'desc' => '创造。'],
                            'en' => ['name' => 'Wealth', 'short_name' => 'W', 'title' => 'Wealth &nbsp;|&nbsp; Sailing', 'desc' => 'Creation.'],
                        ]],
                        // 治变 治权 治化 辖治
//            ['name' => '辖治',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 3, 'order' => 4,  'url' => '/sail/zhi', 'ctitle'=>'','title'=>'',  'show_pic'=>false,'pic'=>null, '_trans'=>['zh'=>[]]],
                    ]],
                    // url: with or one
//            ['id' => $ID['gong_he'],  'name' => '共河',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 2, 'order' => 4,  'url' => '/gong', 'ctitle'=>'','title'=>'',  'show_pic'=>false,'pic'=>'', '_trans'=>['zh'=>[]]],
//            ['id' => $ID['sheng_he'],  'name' => '生河',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>'quote','level' => 2, 'order' => 5,  'url' => '/sheng', 'ctitle'=>'','title'=>'',  'show_pic'=>false,'pic'=>'', '_trans'=>['zh'=>[]]],
                ]],
                // 'url'=>'/culture'
                ['show' => true, 'css' => null, 'type' => 'box', 'level' => 1, 'order' => 2, 'url' => '/library', '_trans' => [
                    'zh' => ['name' => '人文',],
                    'en' => ['name' => 'Library',],
                ], '_children' => [
                    ['show' => true, 'css' => null, 'type' => null, 'level' => 2, 'order' => 1, 'url' => '/book', '_trans' => [
                        'zh' => ['name' => '书架', 'ctitle' => '真城书架', 'title' => '书架 &nbsp;|&nbsp; 真城', 'desc' => '阅读心灵，阅读智慧。',],
                        'en' => ['name' => 'Bookshelf', 'ctitle' => 'Zhen Bookshelf', 'title' => 'Bookshelf &nbsp;|&nbsp; Zhen City', 'desc' => 'Read soul, read wisdom.',],
                    ]
                    ],
                    ['show' => true, 'css' => null, 'type' => null, 'level' => 2, 'order' => 2, 'url' => '/video', '_trans' => [
                        'zh' => ['name' => '视窗', 'ctitle' => '真城视窗', 'title' => '视窗 &nbsp;|&nbsp; 真城', 'desc' => '心灵的影视世界。',],
                        'en' => ['name' => 'Video Window', 'ctitle' => 'Zhen Video Window', 'title' => 'Video Window &nbsp;|&nbsp; Zhen City', 'desc' => 'Window to the soul, window to the world',],
                    ]
                    ],
                    //['name' => '诗抄存', 'show'=>true,  'css' => null, 'type' => null, 'level' => 2, 'order' => 3, 'url' => '/poem', 'ctitle'=>'','title'=>'',  'show_pic'=>false,'pic'=>'', '_trans'=>['zh'=>[]]],
                    //['name' => '趣拾', 'show'=>true,  'css' => null, 'type' => null, 'level' => 2, 'order' => 4, 'url' => '/fun', 'ctitle'=>'','title'=>'',  'show_pic'=>false,'pic'=>'', '_trans'=>['zh'=>[]]],

                ]],
                // 'url'=>'/community'
                ['show' => true, 'css' => null, 'type' => 'box', 'level' => 1, 'order' => 3, 'url' => COUNTRY_URL, '_trans' => [
                    'zh' => ['name' => '山脚下',],
                    'en' => ['name' => 'Hill Foot',],
                ], "_children" => [
                    //['name' => '忆少年', 'show'=>true,  'css' => null, 'type' => null, 'level' => 2, 'order' => 1, 'url' => '/home/qing', 'ctitle'=>'','title'=>'',  'show_pic'=>false,'pic'=>'', '_trans'=>['zh'=>[]]],
                    ['show' => true, 'css' => null, 'type' => null, 'level' => 2, 'order' => 2, 'url' => '/park', '_trans' => [
                        'zh' => ['name' => '未名园',],
                        'en' => ['name' => 'Untitled Park',],
                    ]],
                    ['show' => true, 'css' => null, 'type' => null, 'level' => 2, 'order' => 4, 'url' => '/hamlet', '_trans' => [
                        'zh' => ['name' => '贾鱼村', 'title' => '真城贾鱼村', 'desc' => '在这里，假设人类史。历史可以 cuan gai，为什么就不能假设呢？',],
                        'en' => ['name' => 'Hamlet Hamlet', 'title' => 'Hamlet Hamlet', 'desc' => 'Tampered history there, alternate history here.'],
                    ]],
//                    ['menu_id' => $a_menu_id, 'name' => '假语村', 'show'=>true,  'css' => null, 'type' => null, 'level' => 1, 'order' => 2, 'url' => '/newspeak'],
                    // 石头记/ 天行健 六志 人志 人记 青书
                    // 如果书籍、影视需要搜罗万象，而书架、视窗满足不了，则可改名为“百科”
                    //['name' => '人物表', 'show'=>true,  'css' => null, 'type' => null, 'level' => 2, 'order' => 3, 'url' => '/country/people', 'ctitle'=>'','title'=>'',  'show_pic'=>false,'pic'=>'', '_trans'=>['zh'=>[]]],
//                    ['name' => '淡水湾', 'show'=>true, 'css' => null, 'type' => null, 'level' => 2, 'order' => 5, 'url' => '/bay', 'ctitle'=>'','title'=>'',  'show_pic'=>false,'pic'=>'', '_trans'=>['zh'=>[]]],
                    ['show' => true, 'css' => null, 'type' => null, 'level' => 2, 'order' => 7, 'url' => '/bay', 'pic' => '/img/org/tree.jpg', '_trans' => [
                        'zh' => ['name' => '淡水湾', 'title' => '真城淡水湾', 'desc' => '企园，努力求真。',],
                        'en' => ['name' => 'Zhen Bay', 'title' => 'Zhen Bay', 'desc' => '',],
                    ], '_children' => [
                        ['show' => true, 'css' => null, 'type' => null, 'level' => 3, 'order' => 1, 'url' => '/bay/rules', '_trans' => [
                            'zh' => ['name' => '规则', 'title' => '真城淡水湾规则', 'desc' => '求真第一，自然法起步，其它礼貌对弈。',],
                            'en' => ['name' => 'Rules', 'title' => 'Zhen Bay Rules', 'desc' => '',],
                        ],],
                        ['show' => true, 'css' => null, 'type' => null, 'level' => 3, 'order' => 2, 'url' => '/bay/about', '_trans' => [
                            'zh' => ['name' => '介绍', 'title' => '真城淡水湾的介绍', 'desc' => '淡水湾的 Logo 来自马斯洛的需求模型。',],
                            'en' => ['name' => 'Intro', 'title' => 'Intro About Zhen Bay', 'desc' => 'The logo of Zhen Bay origins from Maslow\'s hierarchy of needs.',],
                        ],],
                    ]],
                    // 城务站
                    ['show' => true, 'css' => null, 'type' => null, 'level' => 2, 'order' => 9, 'url' => '/hall', '_trans' => [
                        'zh' => ['name' => '市政厅', 'title' => '真城市政厅', 'desc' => '真城的财政、组织。',],
                        'en' => ['name' => 'City Hall', 'title' => 'Zhen City Hall', 'desc' => 'Zhen finance and departments.',]
                    ]],
                ]],
            ]
            ],

        ];

        $this->insertColumns($main_menu);

        $a_menu_id = MENU_ID['pass'];

        $a_menu = [
            // mountain pass
            ['menu_id' => $a_menu_id, 'show' => true, 'css' => null, 'type' => null, 'level' => 0, 'order' => 1, 'url' => '/pass',
                '_trans' => [
                    'zh' => ['name' => '山关', 'title' => '真城山关', 'desc' => '真城山关',],
                    'en' => ['name' => 'Pass', 'title' => 'Zhen Pass', 'desc' => 'Zhen Pass',],
                ],
                '_children' => [
                    ['menu_id' => $a_menu_id, 'show' => true, 'css' => null, 'type' => null, 'level' => 1, 'order' => 2, 'url' => '/ferry',
                        '_trans' => [
                            'zh' => ['name' => '渡口', 'title' => '真城渡口', 'desc' => '从这里，到真城',],
                        ],
                    ],
                    // newspeak town 新话镇
//            ['menu_id' => $a_menu_id, 'name' => '真城',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>null,'level' => 1, 'order' => 3,  'url' => '/gate/about'],
//            ['menu_id' => $a_menu_id, 'name' => '规则',  'show'=>true,'short_name'=>null,'css'=>null,'type'=>null,'level' => 1, 'order' => 5,  'url' => '/gate/rules'],

                ]]
        ];

        $this->insertColumns($a_menu);

        $a_menu_id = 3;


        $a_menu_id = MENU_ID['bay'];

        $a_menu = [
            ['menu_id' => $a_menu_id, 'show' => true, 'level' => 0, 'order' => 1, 'url' => '/bay_menu',
                '_trans' => [
                    'zh' => ['name' => '淡水湾'],
                ],
                '_children' => [
                    ['menu_id' => $a_menu_id, '_trans' => [
                        'zh' => ['name' => '规则', 'desc' => '规则是系统的核心。',],
                    ], 'show' => true, 'level' => 1, 'order' => 1, 'url' => '/bay/law',],
                    ['menu_id' => $a_menu_id, '_trans' => [
                        'zh' => ['name' => '教育'],
                    ], 'show' => true, 'level' => 1, 'order' => 1, 'url' => '/bay/play',],
                    ['menu_id' => $a_menu_id, '_trans' => [
                        'zh' => ['name' => '阅读', 'desc' => '书籍/知识/资讯',],
                    ], 'show' => true, 'level' => 1, 'order' => 1, 'url' => '/bay/read',],
                    ['menu_id' => $a_menu_id, '_trans' => [
                        'zh' => ['name' => '学习'],
                    ], 'show' => true, 'level' => 1, 'order' => 1, 'url' => '/bay/learn',],
                    ['menu_id' => $a_menu_id, '_trans' => [
                        'zh' => ['name' => '饮食'],
                    ], 'show' => true, 'level' => 1, 'order' => 1, 'url' => '/bay/food',],
                    ['menu_id' => $a_menu_id, '_trans' => [
                        'zh' => ['name' => '健康', 'desc' => '健康，医疗。',],
                    ], 'show' => true, 'level' => 1, 'order' => 1, 'url' => '/bay/health',],
                    ['menu_id' => $a_menu_id, '_trans' => [
                        'zh' => ['name' => '其它'],
                    ], 'show' => true, 'level' => 1, 'order' => 1, 'url' => '/bay/other',],
                ]
            ]
        ];

        $this->insertColumns($a_menu);

        (new \App\Services\Staticizer)->makeColumnsCacheAndBlade();


    }

    protected function insertColumns(array $columns, $pid = null)
    {
        foreach ($columns as $column) {
            $children = null;
            if (isset($column['_children'])) {
                $children = $column['_children'];
                unset($column['_children']);
            }

            $trans = [];
            if (isset($column['_trans'])) {
                $trans = $column['_trans'];
                unset($column['_trans']);
            }

            if ($pid) $column['pid'] = $pid;

            if ($trans) {
                $data = array_merge($column, $trans);

//                var_dump($data);DB::enableQueryLog();

                $item = \App\Column::create($data);

//                $laQuery = DB::getQueryLog();var_dump($laQuery);exit();

                $item->save();
                $id = $item->id;
            } else {
                print("no trans for $column[url]");
                exit();
            }

            echo "{$trans['zh']['name']}: $id\n";

            if ($children) {
                $this->insertColumns($children, $id);
            }
        }
    }

}
