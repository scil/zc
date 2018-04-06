<?php

//use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->freeDir = storage_path() . '/free/article/';
        $this->sourceDir = __DIR__ . '/article_src/';
        //
        File::cleanDirectory($this->freeDir);
        DB::table('articles')->truncate();
        DB::table('volumes')->truncate();

//        $article_ids = require __DIR__ . '/article_ID.php';
        $person_ids = require __DIR__ . '/person_ID.php';

        $book_id =MENU_ITEMS["writing"]['id'];
        $qing_id = MENU_ITEMS["green"]['id'];

        $ren_nature_id = MENU_ITEMS["human/nature"]['id'];
        $ren_id = MENU_ITEMS["human/road"]['id'];


        $qing_vol_no = 0;

        $column_id = $qing_id;

        $articles = [
            [
//                'id' => $article_ids['Zi'],
                'slug' => 'Zi-ZhongYun',
                'articleable_id'=>$column_id,'title' => '最珍惜独立人格',
                'desc' => '少年时，她徜徉于文学和音乐，对世事无所问；今天，她对窗外事欲罢不能，忧心忡忡。青年时，她曾「坦白一切」；后来，则「能瞒就瞒」。走过上世纪阵阵风雨的资中筠，最珍惜的，是独立之人格。',
                'intro' => '少年时，她徜徉于文学和音乐，对世事无所问；今天，她依然喜欢安静，却对窗外事欲罢不能，忧心忡忡。青年时，她曾「坦白一切」；后来，则「能瞒就瞒」。走过上世纪阵阵风雨的资中筠，最珍惜的，是独立之人格。',
                'author' => '萧辉',
                'origin' => '新京报',
                'origin_date' => '2015-11-11',
                'created_at' => '2017-05-05',
                'show_date' => true,
                'origin_url' => '//www.bjnews.com.cn/news/2015/11/11/383841.html',

                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'comment' => '合并了电子版。电子版篇幅少，但有一点点自己的内容： //epaper.bjnews.com.cn/html/2015-11/11/content_607391.htm?div=0',
                '_vol' => [
                    'title' => '资中筠',
                    'column_id' => $qing_id,
                    'no' => ++$qing_vol_no,
                    'person_id' => $person_ids['Zi'],
                ],
                '_place' => [
                    '_id' => DB::table('places')->where('name', '北京')->first()->id,
                    'info' => [
                        'intro' => '1953 年，挚爱音乐的她烧掉了中学毕业时的音乐会纪念册，「我感到当时别人在为“New China”浴血奋战，我却沉浸在小资产阶级的钢琴调中，很羞愧，就一把火就烧了」，与过去决裂。',
                    ]
                ],
                '_quotes' => [

                    [
                        '_slug' => 'Zi_2',
                        'type' => 'top',
                        'order' => 1,

                        'body' => '我不能不关心外面的事情，这是种本能。',
                        'author' => '资中筠',
                        'origin' => null,
                        'origin_date' => '2015/11/11',
                        'show_date' => false,
                        'origin_url' => '/zhen/shanqin/1',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'Zi_1',
                        'type' => 'top',
                        'order' => 1,

                        'body' => '过去遇到想不通的问题，认为 leader <strong>总是对</strong>的，便努力说服自己，在知道他<strong>也可能犯错</strong>之后，便可以用自己的脑子去想了，这扇窗一打开，就不再能关上，从此心中逐渐亮堂，也就是自我启蒙。 ',
                        'author' => '资中筠',
                        'origin' => null,
                        'origin_date' => '2011/11/05',
                        'show_date' => false,
                        'origin_url' => 'http://www.360doc.com/content/13/0202/20/5316345_263810378.shtml',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'Zi_3',
                        'type' => 'top',
                        'order' => 3,

                        'body' => '和她谈论文化、文学、历史、现实与时弊，常常让我哑然失语，觉得自己不仅没读过几本书，而且是一个连精神上都有腰间盘突出症的严重患者，是一代‘腰痛作家’中的一个。每一次和她的文字与她本人交流之后，我都对自己说：回家多读几本书吧，把你的腰挺得再直一些吧！',
                        'author' => '阎连科',
                        'origin' => null,
                        'origin_date' => null,
                        'show_date' => false,
                        'origin_url' => '',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'Zi_4',
                        'type' => 'top',
                        'order' => 4,

                        'body' => '只是说说话，算不得勇气。我太老了，没有行动能力，对谁也构不成威胁。我还是更佩服那些能够起而行，在艰难中甚至冒着风险为社会切实做出贡献的人。',
                        'author' => '资中筠',
                        'origin' => null,
                        'origin_date' => null,
                        'show_date' => false,
                        'origin_url' => '//news.ifeng.com/shendu/zgxwzk/detail_2014_01/17/33123943_0.shtml',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ]
                ,
                '_note' => [
                    'slug' => 'love-rationality-dndependence',
                    'articleable_id'=>$column_id,'title' => '爱、理性、独立',
                    'intro' => '她不仅仅是爱囶',
                    'desc' => '近九十高龄的资中筠，可称是名副其实的士人。她自言「说了一些平淡无奇的、常识性的话」，而背后是她独立的灵魂之我，是独立之我对身外之物的淡然和对善恶美丑的分明。',
                    'author' => '结巢人境',
                    'author_id' => 1,
                    'origin_date' => '2016-07-20',

                    'status' => 1, 'deep' => 'open',
                    'comment' => '',
                ],
                '_brothers' => [

                    [
                        'slug' => 'Zi-ZhongYun-why-intellectuals-changed',
                        'articleable_id'=>$column_id,'title' => '资中筠：为什么无数知识分子被改造过去了',
                        'intro' => '技术文：如何吸收他人的独立人格',
                        'desc'=>'我们都有一种原罪感，且越来越自卑。想自己“养活”自己？不行。历史上知识分子有私产，不想从政可以退隐。到上世纪 50 年代，所有的私产都没有了，没有任何退路，退隐完全没有可能。',
                        'author' => '结巢人境（编）',
                        'origin' => '',
                        'origin_date' => ' 2006/09/07',
                        'show_date' => true,
                        'origin_url' => null,
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'deep',
                        'created_at' => '2017/05/06',
                        'comment' => '',
//                        '_place' => [
//                            'name' => 'Kreditbanken 银行',
//                            'name_en' => 'Kreditbanken',
//                            'addr' => 'Stockholm',
//                            'address' => 'Norrmalmstorg square in Stockholm, Sweden',
//                            'lat' => 59.333355,
//                            'lng' => 18.0702616,
//                            'comment' => '1923-1974',
//                            'info' => [
//                                'intro' => 'Norrmalmstorg robbery was a bank robbery and hostage crisis best known as the origin of the term Stockholm syndrome.It took place here.',
//                            ]
//                        ],
                    ],
                ],
            ],
            [
//                'id' => $article_ids['Thomas_More'],
                'slug' => 'Thomas-More',
                'articleable_id'=>$column_id,'title' => '与信念同行 —— 小记《乌托邦》作者莫尔',
                'desc'=>'莫尔（More）和王阳明是同代人，小六岁，在英格兰为官，被称为「穷人的庇护者」；他信仰虔诚，身居高位，一如既往磨炼精神，鞭笞苦修；他关心现实，渴望改革，虽然在历史转折的节点上，身边人认为他是顽固的守旧派。',
                'intro' => '莫尔（More）和明朝的王阳明是同代人，小六岁，也是官员，任职欧洲小囶英格兰，因为专业、正直，被称为「穷人的庇护者」；他一样信仰虔诚，身居高位，一如既往磨炼精神，鞭笞苦修；他也关心现实，渴望改革，虽然在历史转折的节点上，身边人认为他是顽固的守旧派。',
                'author' => '结巢人境',
                'author_id' => 1,
                'origin' => null,
                'origin_date' => '2016-06-30',
                'created_at' => '2017-05-01',
                'show_date' => true,
                'origin_url' => '',
                'origin_tip' => null,

                'editor_id' => 1, 'status' => 1, 'deep' => 'member-list',
                'comment' => '',
                '_vol' => [
                    'title' => 'Thomas_More',
                    'column_id' => $qing_id,
                    'no' => ++$qing_vol_no,
                    'person_id' => $person_ids['Thomas_More'],
                ],
                '_place' => [
                    '_id' => DB::table('places')->where('name', '牛津大学')->first()->id,
                    'info' => [
                        'intro' => '1492 年，即 Columbus 发现美洲的同一年，14 岁的 More 来到牛津大学学习语言和文学。之前他刚刚在 Morton 家做了两年小侍者。Morton 是当时的大法官、一位大主教，支持文艺复兴。',
                    ]
                ],
                '_quotes' => [

                    [
                        '_slug' => 'Thomas_More_self',
                        'quoteable_type' => 'Article',
                        'type' => 'top',
                        'order' => 1,

                        'body' => 'I die the king\'s  good servant, but God\'s first.',
                        'author' => 'Thomas More',
                        'origin' => null,
                        'origin_date' => null,
                        'show_date' => false,
                        'origin_url' => '',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ],
                '_notes' => [
                    [
                        'slug' => 'Thomas-More-Henry',
                        'articleable_id'=>$column_id,'title' => '悼念善，也警惕恶',
                        'desc'=>'国王 Henry 正当欧洲王权崛起的时期，他的无法无天导致了 More 的不幸，比纪念 More 同样重要的，是对 Henry 这种无缰之手的反对和防范。',
                        'intro' => '有时，我心里竟有一丝对 Henry 的赞叹。',
                        'author' => '结巢人境',
                        'author_id' => 1,
                        'origin_date' => '2016-06-30',
                        'created_at' => '2016-06-30',

                        'status' => 1, 'deep' => 'deep',
                        'comment' => '',
                    ],
                    [
                        'slug' => 'Thomas-More-against-Protestantism',
                        'articleable_id'=>$column_id,'title' => '迫害新教不能被原谅',
                        'desc' => 'More 对新教的迫害是抹不掉的罪过，不能推诿给所谓时代，功劳比天高也不能折罪。反思过去才能让我们行进的方向向前。',
                        'intro' => 'More 对新教的迫害是个人的罪恶还是时代的悲剧？他能将功补过吗？',
                        'author' => '结巢人境',
                        'author_id' => 1,
                        'origin_date' => '2016-06-30',
                        'created_at' => '2016-06-30',

                        'status' => 1, 'deep' => 'deep',
                        'comment' => '',
                    ],]
            ],

            [
//                'id' => $article_ids['Huang_Yu'],
                'slug' => 'Huang-Yu-goodbye',
                'articleable_id'=>$column_id,'title' => '送别黄渝',
                'desc'=>'我问他的近况，他说还在业余从事数学研究。我当时很想帮他在我们公司找一份正式工作，他表示了一定的兴趣，但似乎还是放不下他的数学梦。那天晚上，我和黄渝握手告别，当时自然是做梦也想不到这就是永别。',
                'intro' => '我问他的近况，他说还在业余从事数学研究。我当时很想帮他在我们公司找一份正式工作，就再次提到来<z-lang lang="en" title="亚特兰大"> Atlanta </z-lang>工作定居的可能性。他表示了一定的兴趣，但似乎还是放不下他的数学梦。那天晚上，我和黄渝握手告别，当时自然是做梦也想不到这就是永别。',
                'author' => '李尚靖(中国科技大学数学系 81 级)',
                'author_id' => null,
                'origin' => null,
                'origin_date' => '2004-12-29',
                'created_at' => '2017-05-11',
                'show_date' => true,
                'origin_url' => 'http://www.mitbbs.com/article_t/USTC/1186975.html',
                'origin_tip' => null,

                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'comment' => '肇事司机是否醉驾？记忆中有人否认，但仔细查找yahoo group没找到',
                '_vol' => [
                    'title' => '黄渝',
                    'column_id' => $qing_id,
                    'no' => ++$qing_vol_no,
                    'person_id' => $person_ids['Huang_Yu'],
                ],
                '_place' => [
                    '_id' => DB::table('places')->where('name', '纽约都会区')->first()->id,
                    'info' => [
                        'intro' => '2004 年圣诞前一个月，黄的车坏在了钓鱼路上，坐火车辗转回家。  
圣诞前几天，黄给家里打电话，询问父母、亲人的情况，谈到自己「研究继续搞着，每个星期去找导师讨论一下，有时导师讲课，就听课」。  
圣诞前一天凌晨，黄在投送报纸的路上突然汽车爆胎，下车检修时遭遇车祸。',
                    ]
                ],
                '_quotes' => [

                    [
                        '_slug' => 'Huang_Yu_self',
                        'type' => 'top',
                        'order' => 1,

                        'body' => '人生的意义在于智慧。',
                        'author' => '黄渝',
                        'origin' => null,
                        'origin_date' => null,
                        'show_date' => false,
                        'origin_url' => '//groups.yahoo.com/neo/groups/ourfriendhuangyu/conversations/topics/63',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'Huang_Yu_ta',
                        'type' => 'top',
                        'order' => 2,

                        'body' => '他为人善良忠厚，乐于助人，从不与人斤斤计较；他一生除了数学，从来没有认真考虑过要做其他事情，对朋友的建议或劝告总是一笑置之。',
                        'author' => '庄得谦',
                        'origin' => null,
                        'origin_date' => '2005/01/07',
                        'show_date' => false,
                        'origin_url' => '//groups.yahoo.com/neo/groups/ourfriendhuangyu/conversations/topics/29',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ]
                ,
                '_note' => [
                    'slug' => 'Huang-Yu-not-forlorn',
                    'articleable_id'=>$column_id,'title' => '黄渝的生前时光称得上“凄凉”吗',
                    'desc' => '黄渝和张益唐常被相提并论，两人都痴迷数学，美囶业结束后求职艰难，幸赖服务员、外卖、送报纸等工作维生。张完成一篇论文震动世界时，黄渝已在 8 年前亡于送报纸的路上，留给人无限的哀思。',
                    'intro' => '几乎是同时知道了黄渝和张益唐。两人都痴迷数学，都到美囶求学，学业结束后求职艰难，幸赖服务员、外卖、送报纸等工作维生。不同的是，张在 2012 年完成了一篇重要的数学论文震动世界，而黄渝，则已在 8 年前亡于送报纸的路上，留给人无限的哀思。',
                    'author' => '结巢人境',
                    'author_id' => 1,
                    'origin_date' => '2016-07-01',
                    'created_at' => '2016-07-01',

                    'status' => 1, 'deep' => 'open',
                    'comment' => '',
                ],
            ],

            [
//                'id' => $article_ids['F'],
                'slug' => 'Richard-Feynman-enjoy-physics-world',
                'articleable_id'=>$column_id,'title' => '彩虹之美——费曼享受的世界',
                'desc' => '堂堂一个大人像猎狗一样趴在地上，这就是自由的 Feynman，走在大自然的美妙世界，在科学的世界里遨游。而当职位的压力袭来时，这个奔放的心灵还能获得自由吗？',
                'intro' => '堂堂一个大人像猎狗一样趴在地上，这就是自由的费曼（Richard Feynman），走在大自然的美妙世界，在科学的世界里遨游。而当职位的压力袭来时，这个奔放的心灵还能获得自由吗？',
                'author' => '费曼（Richard Feynman）',
                'origin' => '《发现的乐趣》等传记',
                'origin_date' => null,
                'show_date' => false,
                'created_at' => '2017-05-15',
                'origin_url' => '',

                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'comment' => '',
                '_vol' => [
                    'title' => 'Richard Feynman',
                    'column_id' => $qing_id,
                    'no' => ++$qing_vol_no,
                    'person_id' => $person_ids['F'],
                ],
                '_note' =>
                    [
                        'slug' => 'individualistic-Richard-Feynman',
                        'articleable_id'=>$column_id,'title' => '个人主义的费曼（兼谈他的「虚荣」）',
                        'intro' => '「不负责任」是费曼的人生哲学，如果他活在我们身边，难免会和这些词汇挂钩：自私自利、不通人情、玩世不恭、老不正经。。。',
                        'desc' => '「不负责任」是费曼的人生哲学，如果他活在我们身边，难免会和这些词汇挂钩：自私自利、不通人情、玩世不恭、老不正经。。。',
                        'author' => '结巢人境',
                        'author_id' => 1,
                        'origin_date' => '2016/08/18',

                        'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                '_place' => [
                    '_id' => DB::table('places')->where('name_en', 'Los Alamos')->first()->id,
                    'info' => [
                        'intro' => '二战时参加 Manhattan Project，成为人人避而远之的开锁贼。Feynman 的幽默感来自她的母亲。',
                    ]
                ],
                '_quotes' => [
                    [
                        '_slug' => 'F_nlogn',
                        'type' => 'top',
                        'order' => 1,

                        'body' => 'I never knew who I was talking to. I was always worried about the physics. If the idea looked lousy, I said it 
looked lousy. If it looked good, I said it looked good. Simple proposition. I\'ve always lived that way. It\'s nice, it\'s pleasant',
                        'author' => 'Richard P. Feynman',
                        'origin' => 'What.Do.You.Care.What.Other.People.Think',
                        'origin_date' => null,
                        'show_date' => false,
                        'origin_url' => '',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'F_freeman',
                        'type' => 'top',
                        'order' => 2,

                        'body' => '<z-lang title="\"half genius and half buffoon.\" Between his heroic struggles to understand the laws of nature, he loved to relax with friends, to play his bongo drums, to entertain everybody with tricks and stories.">他「半是天才半是小丑」：在他为理解自然规律而英勇奋斗的间隙，他喜爱和朋友娱乐消遣，喜爱敲邦戈鼓，喜爱用诡计和故事跟各种人开玩笑。</z-lang>',
                        'author' => 'Freeman J. Dyson',
                        'origin' => null,
                        'origin_date' => '1999/01/01',
                        'show_date' => false,
                        'origin_url' => 'http://www.sitpor.org/wp-content/uploads/2015/03/Helix-Books-Richard-P.-Feynman-The-Pleasure-of-Finding-Things-Out_-The-Best-Short-Works-of-Richard-Feynman-Perseus-Publishing-Company-1999.pdf',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],

                ]
            ],


            [
//                'id' => $article_ids['Liu_Zhenxi'],
                'slug' => 'Liu-Zhenxi',
                'articleable_id'=>$column_id,'title' => '「畸人」刘镇西',
                'desc'=>'他独自像明眼人一样横行于闹市通衢，而且总要高唱着自己所谱的歌曲，旁若无人地行走在他的江湖生涯中。',
                'intro' => '他利器在手，口中念念有词曰——幸有嘉宾至，何妨破门入。手起刀落，门锁已被他砍成两截。就这样，我们在他不足十平米的暗室，杯茶订交，成了今生头颅相许的朋友。《庄子·内篇·大宗师》：「子贡曰：『敢问畸人？』曰：『畸人者，畸於人而侔於天。』」「畸于人而侔于天」，也就是说「畸人」在人世间孤独无匹，却与天道完美契合。',
                'author' => '野夫',
                'author_id' => null,
                'origin' => '《乡关何处》',
                'origin_date' => '2010/08/28',
                'created_at' => '2017-05-11',
                'show_date' => true,
                'origin_url' => 'http://blog.sina.com.cn/s/blog_798650640100s4zj.html',
                'origin_tip' => null,

                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'comment' => '',
                '_vol' => [
                    'title' => '刘镇西',
                    'column_id' => $qing_id,
                    'no' => ++$qing_vol_no,
                    'person_id' => $person_ids['Huang_Yu'],
                ],
                '_place' => [
                    'name' => '湖北利川清江河',
                    'name_en' => 'Qingjiang River',
                    'addr' => '湖北省恩施州利川市',
                    'lat' => 30.290963,
                    'lng' => 108.960458,
                    'oldOrPoint' => [
                        'type' => 'point',
                        'name' => '湖北利川',
                    ],
                    'info' => [
                        'intro' => '他重操旧业，靠在搪瓷碗盆上烧字养活妻女，背着一个简单的木头工具箱，走遍了二十几个省的无数县镇。他和那些江湖手艺人唯一的不同是，他的工具箱里永远放着《楚辞》。',
                    ],
                ],
            ],

            [
//                'id' => $article_ids['Urbani'],
                'slug' => 'Carlo-Urbani-SARS',
                'articleable_id'=>$column_id,
                'title' => '瘟疫袭来 他奔走呼吁 冲在前方',
                'sub_title' => '记抵御 SARS 病毒的天主教医生 Urbani',
                'desc'=>'Urbani 因为 SARS 而广为人知，是他的专业和尽心尽力遏制了病毒，而他的博爱胸怀，更让我们怀念。 ',
                'intro' => '一场起于青萍之末的疫情，在事发地的“低调处理”中越变越大，染病的专业医生，携带着病毒，堂而皇之进入国际大都市，引爆了世界性传染，而本地官员依然麻木不仁。直到病毒闯入越南，是乌尔巴尼（Urbani），一名从意大利半岛来到印度支那的医生，向世界发出了警讯；人们风声鹤唳、四散奔逃，身在异乡的他，仍然坚守在那里，尽自己的最大努力，广泛联系各方力量，建立起抵御病毒的防线。回顾他的半生，Urbani 好像同样来自意大利岛的天主教徒利玛窦，带着文明的火种，奔走在世界的洼地。',
                'author' => '结巢人境（编）',
                'author_id' => 1,
                'origin' => '',
                'origin_date' => '2017-12-05',
                'created_at' => '2017-12-07',
                'show_date' => false,
                'origin_url' => 'http://www.eywedu.com/Bolanqunshu/blqs2003/blqs20030902.html',
                'origin_tip' => null,

                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'comment' => null,
                '_vol' => [
                    'title' => 'Urbani',
                    'column_id' => $qing_id,
                    'no' => ++$qing_vol_no,
                    'person_id' => $person_ids['Carlo_Urbani'],
                ],
                '_place' => [
                    'name' => '河内法囶医院',
                    'name_en' => 'French Hospital of Hanoi',
                    'addr' => 'Vietnam',
                    'lat' => 21.0039009,
                    'lng' => 105.838117,
                    'info' => [
                        'intro' => '疫情蔓延到这里，终于遭到了阻击。',
                    ],
                ],
                '_quotes' => [

                    [
                        '_slug' => 'U_self',
                        'type' => 'top',
                        'order' => 1,

                        'body' => 'If I can\'t work in such situations, what am I here for? Answering e-mails, going to cocktail parties and pushing paper?（如果我不能在这样的情况下工作，我到这来是干什么的？回邮件，参加鸡尾酒会，坐办公室？）',
                        'author' => 'Carlo Urbani',
                        'origin' => null,
                        'origin_date' => '2003/04/26',
                        'show_date' => false,
                        'origin_url' => 'http://www.msf.org/en/article/obituary-carlo-urbani',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ]
                ,
                '_brothers' => [
//                    [
//                        'slug' => '',
//                        'articleable_id'=>$column_id,'title' => '孩子没有责任感，只会打游戏怎么办？
//孩子没有责任感，只会打游戏怎么办？
//',
//                        'intro' => '',
//                        'author' => '布尔费墨',
//                        'origin' => '',
//                        'origin_date' => '2017-04-19',
//                        'show_date' => false,
//                        'origin_url' => 'http://weibo.com/ttarticle/p/show?id=2309404098265862828879',
//                        'copyright' => '',
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                        'comment' => '',
//                        '_vol' => [
//                            'title' => '自主',
//                            'column_id'=> $column_id,
//                            'no' => ++$column_no_start,
//                            'person_id' => null,
//                        ],
////                '_place'=>[
////                    'name' => '',
////                    'name_en' => '',
////                    'addr' => '',
////                    'address' =>'',
////                    'lat' => 31.244831,
////                    'lng' =>121.475756,
////                    'comment'=>'',
////                ],
//                    ],
                ],
            ],
            [
                'slug' => 'miss-Lu-Zuofu',
                'articleable_id'=>$column_id,'title' => '石壁上，凿刻着「敬怀至友作孚兄」',
                'desc' => '卢作孚一生走过许多地方，但他最爱此地。这是他的亲爱的北碚，花园一样的北碚，举世闻名的北碚。他开发建设了北碚，他生前却决不允许用他的名字命名这里的任何一座建筑任何一个地方',
                'intro' => '卢作孚一生走过许多地方，但他最爱此地。这是他的亲爱的北碚，花园一样的北碚，举世闻名的北碚。他开发建设了北碚，他生前却决不允许用他的名字命名这里的任何一座建筑任何一个地方',
                'author' => '赵晓铃',
                'origin' => '《卢作孚的选择》',
                'origin_date' => '2008/07/01',
                'show_date' => false,
                'origin_url' => '',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'comment' => '',
                '_place' => [
                    'name' => '国际乡村改造学院',
                    'name_en' => 'International Institute of Rural Reconstruction',
                    'addr' => 'Philippines',
                    'lat' => 14.2615652,
                    'lng' => 120.9674159,
                    'info' => [
                        'intro' => '1982 年，89 岁高龄的晏阳初撰文怀念阔别半生的至友卢作孚。30 多年前，他劝卢乘桴浮于海，从此天人永隔。',
                    ],
                ],
                '_vol' => [
                    'title' => '卢作孚',
                    'column_id' => $qing_id,
                    'no' => ++$qing_vol_no,
                    'person_id' => $person_ids['Lu_Zuofu'],
                ],
                '_quotes' => [

                    [
                        '_slug' => 'Huang_Yu_self',
                        'type' => 'top',
                        'order' => 1,

                        'body' => '最好的报酬是求仁得仁——建筑一个美好的公园，便报酬你一个美好的公园；建设一个完整的囶家，便报酬你一个完整的囶家。这是何等伟大而且可靠的报酬！它可以安慰你的灵魂，它可以沉溺你的终身，它可以感动无数人心，它可以变更一个社会，乃至于社会的风气……',
                        'author' => '卢作孚《工作的报酬》',
                        'origin' => null,
                        'origin_date' => null,
                        'show_date' => false,
                        'origin_url' => '',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'Huang_Yu_ta',
                        'type' => 'top',
                        'order' => 2,

                        'body' => '一个没有受过学校教育的学者，一个没有现代个人享受要求的现代企业家，一个没有钱的大亨。',
                        'author' => '',
                        'origin' => '《卢作孚与他的长江船队》（美《亚洲与美洲》杂志）',
                        'origin_date' => '2005/01/07',
                        'show_date' => false,
                        'origin_url' => '',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ],

                '_brothers' => [
                    [
                        'slug' => 'Lu-Zuofu-microbe',
                        'articleable_id'=>$column_id,'title' => '「微生物」之路：从文人到官员，从官员到商人',
                        'desc' => '如何发展中囶？卢作孚的探索之路。',
                        'intro' => '如何发展中囶？卢作孚的探索之路。',
                        'author' => '结巢人境（编）',
                        'author_id' => 1,
                        'origin' => '',
                        'origin_date' => '2017-12-05',
                        'created_at' => '2017-12-05',
                        'show_date' => false,
                        'origin_url' => 'http://www.eywedu.com/Bolanqunshu/blqs2003/blqs20030902.html',
                        'origin_tip' => null,

                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => null,
                        '_place' => [
                            'name' => '北碚卢作孚纪念馆',
                            'name_en' => '',
                            'addr' => '重庆市北碚区',
                            'lat' => 29.8332376,
                            'lng' => 106.4371439,
                            'oldOrPoint' => [
                                'type' => 'old',
                                'name' => '江巴璧合特组峡防局',
                            ],
                            'info' => [
                                'intro' => '1927 年，作孚任峡防局局长，他在剿匪同时，进行乡村建设实验，成就斐然。当时“峡防局”一直是北碚行政中心，卢作孚、卢子英兄弟有关乡村建设的大部分决策都在此制定实施。',
                            ],
                        ],
                    ],
//                    [
//                        'slug' => '',
//                        'articleable_id'=>$column_id,'title' => '孩子没有责任感，只会打游戏怎么办？
//孩子没有责任感，只会打游戏怎么办？
//',
//                        'intro' => '',
//                        'author' => '布尔费墨',
//                        'origin' => '',
//                        'origin_date' => '2017-04-19',
//                        'show_date' => false,
//                        'origin_url' => 'http://weibo.com/ttarticle/p/show?id=2309404098265862828879',
//                        'copyright' => '',
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                        'comment' => '',
//                        '_vol' => [
//                            'title' => '自主',
//                            'column_id'=> $column_id,
//                            'no' => ++$column_no_start,
//                            'person_id' => null,
//                        ],
////                '_place'=>[
////                    'name' => '',
////                    'name_en' => '',
////                    'addr' => '',
////                    'address' =>'',
////                    'lat' => 31.244831,
////                    'lng' =>121.475756,
////                    'comment'=>'',
////                ],
//                    ],
                ],
            ],


        ];


        $create_time = time() - 100000;
        // book
        $column_id = $book_id;
        $column_no_start = 0;
        $articles = array_merge($articles, [
            [
                'slug' => 'Self-Actualization',
                'articleable_id'=>$column_id,'title' => '一个作曲家必须作曲——自我实现的 19 个特征',
                'desc' => '自我实现者通常有一些人生的使命，一些有待完成的任务，一些他们自身以外、召集他们大部分精力的问题。',
                'intro' => 'Maslow 有两位非常崇敬的老师，人类学家 Ruth Benedict 和心理学家韦特海默，两人的思想和品格对 Maslow 产生了深刻影响。Maslow 渴望了解是什么使两位学者如此卓尔不群。Maslow 通过研究对人类做出杰出贡献的伟大人物，以及有望成为自我实现者的优秀学生，写下了本文。',
                'author' => '马斯洛( Abraham Maslow )',
                'origin' => '《动机与人格》 1954;1970二版 ',
                'origin_date' => '1954/01/01',
                'show_date' => false,
                'origin_url' => '',

                'copyright' => '',

                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/06/04',
                'comment' => '',
                '_vol' => [
                    'title' => '自我实现',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => '纽约城市大学布鲁克林学院(Brooklyn College)',
                    'name_en' => 'Brooklyn College',
                    'addr' => 'New York',
                    'lat' => 40.9605098,
                    'lng' => -76.2633296,
                    'info' => [
                        'intro' => '二战前夕的 1938 年，Maslow 迎来了孩子 Ann 的出生，还考察黑脚印第安人（Blackfoot Indians），开始对行为主义产生怀疑，认为人不是被环境任意涂抹的白纸。',
                        'relation' => false,
                    ]
                ],
                '_note' => [
                    'slug' => 'Self-Actualization-is-a-continual-process',
                    'articleable_id'=>$column_id,'title' => '自我实现是个不断持续的过程',
                    'intro' => '它是层次中的一部分，但不是终点，它是完成中的，也许还是过渡的。',
                    'desc' => '自我实现不是终点。',
                    'author' => '结巢人境',
                    'author_id' => 1,
                    'created_at' => '2016/09/03',

                    'status' => 1, 'deep' => 'open',
                    'comment' => '',
                ],
//                '_quotes' => [
//                    [
//                        '_slug' => 'self_1',
//                        'type' => 'tail',
//                        'order' => 1,
//
//                        'body' => '（马斯洛的自我实现者与圣人的区别）中囶古代圣人主要是从道德角度讲的，对别的方面也重视，可是不够。自我实现有道德方面，但不限于道德方面。“知、情、意”都应当有。马斯洛讲的自我实现是比较全面的。',
//                        'author' => '张岱年',
//                        'origin' => null,
//                        'origin_date' => '1988/01/01',
//                        'show_date' => false,
//                        'origin_url' => 'http://blog.sina.com.cn/s/blog_50b541b80102vi23.html',
//                        'origin_tip' => null,
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'comment' => '',
//                    ],
//                ]
            ],

            [
                'slug' => 'idealistic-lifestyle-friends-love-teaching',
                'articleable_id'=>$column_id,'title' => '一种接近理想主义的活法 —— 我那些热爱教书的朋友们',
                'desc' => '他完全可以留在广州，但他对“分配”没做什么努力，说，在哪里都是教书。他特别热爱教书，动辄声称要在这里「从教而终」。刚开始我觉得他被洗脑了，对教师一职怀有浪漫想象。',
                'intro' => '他完全可以留在广州，但他对“分配”没做什么努力，说，在哪里都是教书。他特别热爱教书，动辄声称要在这里「从教而终」。刚开始我觉得他被洗脑了，对教师一职怀有浪漫想象。',
                'author' => '陈思呈',
                'origin' => 'dajia',
                'origin_date' => '2015/09/10',
                'show_date' => true,
                'origin_url' => 'http://dajia.qq.com/blog/474844089690185.html',

                'copyright' => '',

                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/05/06',
                'comment' => '',
                '_vol' => [
                    'title' => '理想主义的活法',
                    'column_id' => $book_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => '广东开平市第一中学',
                    'name_en' => '',
                    'addr' => '广东江门开平市',
                    'address' => '广东省江门市开平市祥龙南路',
                    'lat' => 22.3252288,
                    'lng' => 112.6009445,
                    'info' => [
                        'intro' => '1997 年秋，几个师范同学在潭江边的中学做实习老师。',
                        'relation' => false,
                    ]
                ],
            ],
//            [
//                'slug' => 'go-by-poems',
//                'articleable_id'=>$column_id,'title' => '按照诗歌行事，向永恒的春天逃避',
//                'intro' => '我们情愿它居于山巅和废墟之上，屹立于雪崩之中，筑巢在狂风里，而不愿它向永恒的春天逃避。',
//                'author' => '宋石男',
//                'origin' => '',
//                'origin_date' => '2016/03/31',
//                'show_date' => true,
//                'origin_url' => 'http://t12292523.lofter.com/post/1cbf9b01_a750191',
//
//                'copyright' => '',
//
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => '2017/05/16',
//                'comment' => '',
//                '_vol' => [
//                    'title' => '不苟且',
//                    'column_id' => $book_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
//                '_place' => [
//                    'name' => '维克多·雨果之家',
//                    'name_en' => 'Maison de Victor Hugo',
//                    'addr' => 'Paris, France',
//                    'lat' => 48.8548007,
//                    'lng' => 2.3640231,
//                    'comment' => '1605年建成，维克多·雨果1832年到1848年之间的16年居住在这里。博物馆拥有一个中国风格的客厅和中世纪风格的餐厅维以及卧室，他1885年在那里去世',
//                    'info' => [
//                        'intro' => '1831 年，30 岁的雨果出版了诗集《秋叶集》和长篇《巴黎圣母院》。《秋叶集序》提出强调作家创作的主观精神和心灵的能动作用。《巴黎圣母院》在沙皇统治下的俄囶遭禁。',
//                        'relation' => false,
//                    ]
//                ],
//            ],
            [
                'slug' => 'highly-effective-free-will',
                'articleable_id'=>$column_id,'title' => '高效能任性',
                'desc' => '为什么要做个有道德的人？因为我不做任何人、任何东西、或者任何感情的奴隶，我想做一个主人。',
                'intro' => '为什么要做个有道德的人？因为我不做任何人、任何东西、或者任何感情的奴隶，我想做一个主人。',
                'author' => '万维钢',
                'origin' => '知乎专栏',
                'origin_date' => '2015/04/17',
                'show_date' => true,
                'origin_url' => 'https://zhuanlan.zhihu.com/p/20005406',

                'copyright' => '',

                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/05/17',
                'comment' => '',
                '_vol' => [
                    'title' => '不苟且',
                    'column_id' => $book_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => '柯尼斯堡大教堂',
                    'name_en' => 'Königsberg Cathedral',
                    'addr' => '加里宁格勒, 俄罗斯',
                    'lat' => 54.7063834,
                    'lng' => 20.5098527,
                    'info' => [
                        'intro' => '<z-lang en=\'"To be trusted is a greater compliment than to be loved."\'>「有两样东西，我们越是时常反复地思索，心中越是充满永远新鲜、有加无减的赞叹和敬畏——头上的灿烂星空和心中的道德律。」</z-lang> 1804 年，康德安眠于家乡东普鲁士首府柯尼斯堡的教堂（目前属俄罗斯领土）',
                    ]
                ],
            ],
//            [
//                'slug' => "no-talking-about-your-soul-plan-for-new-year",
//                'articleable_id'=>$column_id,'title' => '不要谈论你灵魂的新年计划',
//                'intro' => '人应该像奔马一样迎着命运甩开蹄子飞奔，撞上自己的命运，把它扛在肩上大步流星。人都是活一天少一天，只有来不及完成的梦想，没有打发不了的日子。',
//                'author' => '宋石男',
//                'origin' => '',
//                'origin_date' => '2016/02/22',
//                'show_date' => true,
//                'origin_url' => 'http://mp.weixin.qq.com/s?__biz=MzAxNjU2MzA2OQ==&mid=406851333&idx=1&sn=88b9e70cf06b176582db455c3e1d3dd9',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                'comment' => '',
//                '_vol' => [
//                    'title' => '计划',
//                    'column_id' => $book_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
//            ],
//            [
//                'slug' => '活下去的方式',
//                'articleable_id'=>$column_id,'title' => '活下去的方式',
//                'intro' => '一个良心未泯之人，如果不能像孙立平教授那样疯狂地到处拍照，或者像邻居们那样没黑没夜地打麻将，还是学会自我放逐吧，记住，这个世界，也许并不需要你的才华！看开点。或者，假装看开点。',
//                'author' => '张鸣',
//                'origin' => '',
//                'origin_date' => '2016/06/28',
//                'show_date' => true,
//                'origin_url' => 'http://weibo.com/ttarticle/p/show?id=2309403991254269624154',
//                'copyright'=>'',
//                'editor_id' => 1,  'status' => 1, 'deep' => 'open',
//                'created_at'=> date('Y/m/d h:i:s',$create_time++ ),
//                'created_at'=> date('Y/m/d h:i:s',$create_time+ $column_no_start*10000 ),
//                'comment' => '',
//                '_vol' => [
//                    'title' => '活下去',
//                    'column_id' => $book_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
//                '_note' => [
//                    'slug' => '活下去的方式-note',
//                    'articleable_id'=>$column_id,'title' => '这里的土壤不长人',
//                    'intro' => '徐怀谦、孙仲旭、朝格图、江绪林、林嘉文、朱铁志、宫铃……',
//                    'author' => '结巢人境',
//                    'author_id' => 1,
//                    'created_at' => '2016/09/03',
//
//                    'status' => 1, 'deep' => 'open',
//                    'comment' => '',
//                ],
//            ],
//            [
//                'slug' => '价值观',
//                'articleable_id'=>$column_id,'title' => '我们的价值观是怎么样的',
//                'intro' => '假如一种文明是命定的动物文明，那我们可能会面临这样的疑问：是活在别人的眼里还是活在另一个的世界里？是为别人活还是为自己活？也许当我们这样困惑的时候，我们已经决定了出让自己。',
//                'author' => '李妍',
//                'origin' => '人人网',
//                'origin_date' => '2012/01/09',
//                'show_date' => true,
//                'origin_url' => 'http://blog.renren.com/share/221304009/11036887289',
//
//                'copyright' => '',
//
//                'editor_id' => 1, 'column_id' => $poem_id, 'status' => 1, 'deep' => 'open',
//            'created_at'=> date('Y/m/d h:i:s',$create_time+ $column_no_start*10000 ),
//                'comment' => '',
//            ],
//            [
////                'id' => $article_ids['Han_Suan'],
//                'slug' => 'Han-Suan',
//                'articleable_id'=>$column_id,'title' => '坦然地寒酸',
//                'intro' => '',
//                'author' => '陈思呈',
//                'origin' => 'dajia',
//                'origin_date' => '2014/12/25',
//                'show_date' => true,
//                'origin_url' => 'http://mp.weixin.qq.com/s?__biz=MzA5NDg3NDk2Nw==&mid=403154948&idx=1&sn=38f3102d5533f46d0c616eeb56b57ae1',
//
//                'copyright' => '',
//
//                'editor_id' => 1, 'column_id' => $poem_id, 'status' => 1, 'deep' => 'open',
//            'created_at'=> date('Y/m/d h:i:s',$create_time+ $column_no_start*10000 ),
//                'comment' => '',
//            ],


        ]);

        // ren nature
        $column_id = $ren_nature_id;
        $create_time = $create_time + 1000;
        $column_no_start = 0;
        $column_id = $ren_nature_id;
        $articles = array_merge($articles, [
            [
                'slug' => 'most-precious-thing-for-everyone',
                'articleable_id'=>$column_id,'title' => '每个人骨子里最珍爱的东西',
                'desc' => '这位好强的妈妈，她的问题就是对孩子管得太细太严。就人的天性来说，没有人喜欢自己眼前整天矗立一个权威。',
                'intro' => '她把所有的心思都投入到孩子的教育中，大到说话如何发音标准，小到如何抓筷子如何玩耍，都进行着认真的指导，只要孩子哪些地方做得不好，就立即指出来，并告诉孩子应该如何如何做。',
                'author' => '尹建莉',
                'origin' => '《好妈妈胜过好老师》2009.1',
                'origin_date' => '2009/01/01',
                'show_date' => false,
                'origin_url' => '',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/06/01',
                'comment' => '',
                '_place' => [
                    'name' => 'The Great Salt Lake Shorelands Preserve',
                    'addr' => 'Utah, USA',
                    'lat' => 37.0625,
                    'lng' => -95.677068,
                    'info' => [
                        'intro' => '1987 年，一只 flamingo 鸟逃脱饲养场，它在大盐湖海岸安家过冬，将近 20 年，成为传奇，人们用一个著名的英囶摇滚乐队给它命名：Pink Floyd（粉色弗洛依德）。',
                        'relation' => false,
                    ]
                ],
                '_quotes' => [

                    [
                        '_slug' => 'ziyou1',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '孩子天性中有太多优秀的品质，喜欢探索和发现，敢于尝试和面对未知，并且有着天然的学习兴趣和专注力。  
孩子们用自己的方式，慢慢认识和了解这个未知的充满趣味的世界。  
而大多数父母，用自己所谓对的，正确的方式，给孩子设置了一道一道的障碍，破坏了孩子的兴趣和专注，让学习这件事变的恐怖。  
作为父母的人生课题，就是「放手让孩子去做」。',
                        'author' => '赵欣',
                        'origin' => '《最好的教育，其实是“不教育”》',
                        'origin_date' => '2016/10/21',
                        'show_date' => true,
                        'origin_url' => '//www.jianshu.com/p/bec0e778ba93',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ],
                '_vol' => [
                    'title' => '自由',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
//                '_place'=>[
//                    'name' => '',
//                    'name_en' => '',
//                    'addr' => '',
//                    'address' =>'',
//                    'lat' => 31.244831,
//                    'lng' =>121.475756,
//                    'comment'=>'',
//                ],
                '_brothers' => [
                    [
                        'slug' => 'no-need-to-be-accompanied',
//                'slug' => 'doing-homework-and-human-nature',
                        'articleable_id'=>$column_id,'title' => '孩子需要陪吗',
                        'desc' => '很多媒体、教师或“教育专家”都在建议家长应每天陪着孩子写作业。但是，一个人，首先是个自由的人，才可能成为一个自觉的人。',
                        'intro' => '很多媒体、教师或“教育专家”都在建议家长应每天陪着孩子写作业，这种说法不知他们是怎么想出来的。一个人，首先是个自由的人，才可能成为一个自觉的人。',
                        'author' => '尹建莉',
                        'origin' => '《好妈妈胜过好老师》2009.1',
                        'origin_date' => '2009/01/01',
                        'show_date' => false,
                        'origin_url' => '',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                        'comment' => '',
                    ],
//                    [
//                        'slug' => '',
//                        'articleable_id'=>$column_id,'title' => '孩子没有责任感，只会打游戏怎么办？
//孩子没有责任感，只会打游戏怎么办？
//',
//                        'intro' => '',
//                        'author' => '布尔费墨',
//                        'origin' => '',
//                        'origin_date' => '2017-04-19',
//                        'show_date' => false,
//                        'origin_url' => 'http://weibo.com/ttarticle/p/show?id=2309404098265862828879',
//                        'copyright' => '',
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                        'comment' => '',
//                        '_vol' => [
//                            'title' => '自主',
//                            'column_id'=> $column_id,
//                            'no' => ++$column_no_start,
//                            'person_id' => null,
//                        ],
////                '_place'=>[
////                    'name' => '',
////                    'name_en' => '',
////                    'addr' => '',
////                    'address' =>'',
////                    'lat' => 31.244831,
////                    'lng' =>121.475756,
////                    'comment'=>'',
////                ],
//                    ],
                ],
            ],
            [
                'slug' => 'boil-the-eagle',
                'articleable_id'=>$column_id,'title' => '熬鹰者说',
                'intro' => '熬鹰就得出尽狠招。饿得前胸贴后背，它肯定没有其他心思，心里总想着这口肉。这时人再拿着肉喂它，它就会消除对人的敌意。时间长了，它就会明白一件事，要想吃饭，只有找人。',
                'intro' => '熬鹰就得出尽狠招。饿得前胸贴后背，它肯定没有其他心思，心里总想着这口肉。这时人再拿着肉喂它，它就会消除对人的敌意。时间长了，它就会明白一件事，要想吃饭，只有找人。',
                'author' => '于谦',
                'origin' => '《玩儿》',
                'origin_date' => ' 2012/09/01',
                'show_date' => false,
                'origin_url' => 'http://www.99lib.net/book/6873/236456.htm',
                'order' => 1,
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/06/02',
                'comment' => '',
                '_vol' => [
                    'title' => '斯德哥尔摩综合症',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => '故宫',
                    'lat' => 39.9163447,
                    'lng' => 116.3949606,
                    'oldOrPoint' => [
                        'type' => 'old',
                        'name' => '紫禁城',
                    ],
                    'info' => [
                        'intro' => '康熙：致治以服人心为本，人心服更无余事矣',
                        'relation' => false,
                    ]
                ],
                '_brothers' => [

                    [
                        'slug' => 'how-to-tame-people',
                        'articleable_id'=>$column_id,'title' => '如何驯化人',
                        'intro' => '如何制造斯德哥尔摩综合症病人',
                        'intro' => '几个人被劫持为人质，警察来救，他们反而将劫持者掩护起来，此后甚至拒绝提供不利于绑匪的证词。更为离奇的是，其中一名女人质还由此爱上了一名劫持者，等他获释后就要嫁给他。',
                        'author' => '张轲风',
                        'origin' => '',
                        'type' => 'first',
                        'order' => 2,
                        'origin_date' => ' 2006/09/07',
                        'show_date' => true,
                        'origin_url' => 'http://blog.sina.com.cn/s/blog_4a6c3839010006kc.html',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => '2017/06/02',
                        'comment' => '',
                        '_place' => [
                            'name' => 'Kreditbanken 银行',
                            'name_en' => 'Kreditbanken',
                            'addr' => 'Stockholm',
                            'address' => 'Norrmalmstorg square in Stockholm, Sweden',
                            'lat' => 59.333355,
                            'lng' => 18.0702616,
                            'comment' => '1923-1974',
                            'info' => [
                                'intro' => 'Norrmalmstorg robbery was a bank robbery and hostage crisis best known as the origin of the term Stockholm syndrome.It took place here.',
                            ]
                        ],
                    ],
                ],
            ],
            [
                'slug' => "Chinese-migrate",
                'articleable_id'=>$column_id,'title' => '华人人安土重迁吗？汉字「移」别解',
                'desc' => '农耕民族是「见利思迁」——只要有更广阔、更肥沃、无人耕种的土地，他们一定会「适彼乐土」。中国人如此，希腊人一样。不过，希腊人向往的可能是橄榄树。',
                'intro' => '比起游牧民族，农耕民族相对安定一些，但绝不是说，他们是安土重迁的，而是「见利思迁」——只要有更广阔、更肥沃、无人耕种的土地，他们一定会「适彼乐土」。中国人如此，希腊人一样。不过，希腊人向往的可能是橄榄树。',
                'author' => '刘云枫',
                'origin' => '',
                'origin_date' => '2010-12-22',
                'show_date' => true,
                'origin_url' => 'http://blog.creaders.net/u/8399/201407/185781.html',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/06/10',
                'comment' => '',
                '_vol' => [
                    'title' => '迁移',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => '曼多尔|东万律',
                    'name_en' => 'Mandor',
                    'addr' => '印度尼西亚',
                    'address' => '',
                    'lat' => 0.328342,
                    'lng' => 109.2313704,
                    'info' => [
                        'intro' => '1777 年，即美利坚建国的第二年，华人在南洋建立兰芳共和国，创建人罗芳伯列入《中国殖民八大伟人传》',
                        'relation' => false,
                    ]
                ],
//                '_tags'=>['孝'],
                '_quotes' => [

                    [
                        '_slug' => 'yi-1',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '朱之瑜，生于 1600 年（明万历二十八），长兄任南京神武营总兵后，随长兄寄籍松江府，研究古学，尤擅长《诗》、《书》。1638 年（崇祯十一）朱之瑜以“文武全才第一”荐于礼部，而朱见「世道日坏、国是日非」、「官为钱得，政以贿成」，朝政紊乱，就放弃仕途，专注于学问。朱不求功名利禄，而热衷於关心社会民生，并经常对人讲：「世俗之人以加官进禄为悦，贤人君子以得行其言为悦。言行，道自行也。盖世俗之情，智周一身及其子孙。官高则身荣，禄厚则为子孙数世之利，其愿如是止矣。大人君子包天下以为量。在天下则忧天下，在一邦则忧一邦，惟恐民生之不遂。至於一身之荣瘁，禄食之厚薄，则漠不关心，故惟以得行其道为悦。」

明亡后常年为光复华夏奔波求援。1660 年，受郑成功、张煌言邀，返囶抗清，次年北伐军收复瓜州，攻克镇江，朱之瑜都亲历行阵。北伐军兵威震动东南，惜在南京城外落败。郑成功转而退驻福建沿海，后行师海上，不得已而趋兵台湾，张煌言数年后被捕遇害。朱之瑜鉴于复明无望，又誓死不剃发，「乃次蹈海全节之志」，学鲁仲连不帝秦，再次凄沧渡日，永不回到故囶了。这年冬，最后一次东渡日本，未能获准登岸，困守舟中。当时日本施行锁国政策、「三四十年不留一唐人」。日本学者安东守约，以手书向朱之瑜问学，执弟子礼。朱之瑜为安东守约「执礼过谦」的恭敬、「见解超卓」的学问所动，复信安东守约。信中，朱氏悲喜交集，悲则囶破家亡，故囶「学术之不明、师道之废坏亦已久矣」；喜则「岂孔颜之独在中华，而尧舜之不绝于异域」，表达了他有意将圣贤践履之学传于这位异囶弟子的心情。正如梁启超所说，此「为先生讲学之发轫」。 安东守约等人为其在日定居奔走。最后得日本政府批准，破 40 年来日本幕府之国禁，让他在长崎租屋定居下来，朱之瑜就此结束了十多年的海上漂泊生活。

日本副将军德川光国礼聘朱氏讲学，并欲为建新居，朱以「耻逆虏之末灭，痛祭祀之有阙，若丰屋而安居，非我志」四次力辞。 

朱舜水 83 岁辞世，留下遗言：「予不得再履汉土，一睹恢复事业。予死矣，奔赴海外数十年，未求得一师与满虏战，亦无颜报明社稷。自今以往，区区对皇汉之心，绝于瞑目。见予葬地者，呼曰『故明人朱之瑜墓』，则幸甚。」东京大学农学院内至今立有「朱舜水先生终焉之地」（临终之地）的石碑。',
                        'author' => '',
                        'origin' => '浙江余姚四先贤 之 朱之瑜',
                        'origin_date' => '2011-07-14',
                        'show_date' => true,
                        'origin_url' => 'http://www.yy.gov.cn/art/2011/7/14/art_21849_870465.html',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi0',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => 'Where liberty dwells, there is my country.',
                        'author' => 'Benjamin Franklin',
                        'origin' => '',
                        'origin_date' => null,
                        'show_date' => false,
                        'origin_url' => '',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi4',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 2,

                        'body' => '大约三千多年前，以色列人在埃及为奴，摩西依靠神的力量显了很多神迹，费了九牛二虎之力才劝说加威胁法老让以色列人走。法老很快又改变了主意，派兵来追，摩西伸出手杖劈开红海，以色列人才得以逃命而去。按说以色列人终于得了自由，应该感激涕零才对。但并不是这样的，民众一会儿抱怨没水喝，一会儿抱怨没吃的。后来摩西派出12名探子去伽南地侦察。探子们回来说，伽南的确是物产丰富，但伽南人体高力大，城池强固，和他们相比，我们就像蚂蚱一样。去攻打那是去送死；只有两个探子，迦勒(Caleb)和约书亚(Joshua)，回来说只要我们遵从神的旨意，我们就一定能赢。以色列的民众听了就哭号起来：我们在埃及当奴隶好好的，神为什么要带到这块荒地来，让我们死无葬身之地，还不如回埃及去吧。摩西最终也没有看到伽南的美景，他带领着以色列人出了埃及，在旷野里游荡了40年之久。临终前他登上尼泊山(Nebo)，神让他远远望见应许给他子孙的土地。摩西死的时候120岁。此后，约书亚成为以色列人的领袖，带领民众杀出一条血路，终于进入了应许之地。',
                        'author' => '白露为霜',
                        'origin' => null,
                        'origin_date' => '2014/10/06',
                        'show_date' => true,
                        'origin_url' => 'http://www.sinovision.net/home.php?mod=space&do=blog&uid=163286&id=237633',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi1',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '不管是摩西渡海，还是《硕鼠》传唱，在「追求没有奴役，没有剥削的理想国」这一件事情上，东西方文化殊途同归。',
                        'author' => '滕礼',
                        'origin' => '《诗经 • 硕鼠》与《圣经 • 出埃及记》',
                        'origin_date' => '2015/12/18',
                        'show_date' => true,
                        'origin_url' => 'http://www.55df.com/c/86527.shtml',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi2',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '候鸟伴寒暑交替来来去去，人们早司空见惯；北美驯鹿随季节在林地与高原冻土地带间往返，也延续了千百年；非洲草原上，野生动物因应雨季和旱季而进行的大迁徙，其壮观场面如今已经成为了肯尼亚、坦桑尼亚线路旅游的热点。作为万物灵长的人类，意识深处自然也澎湃着这种对生命的渴望。不说以化石和染色体线粒体分析作依据的蒙昧时代走出非洲，就是进入文明纪元后，许多民族的早期记忆里也都保留了迁徙的影子。《圣经》的《出埃及记》中，摩西带领着以色列人穿过红海，最终到达“流奶与蜜的地”迦南；《诗经·大雅》的《生民》、《公刘》、《绵》、《皇矣》、《大明》五篇周民族史诗中，氏族首领也是带领众人一迁再迁；古印度吠陀文化的创立者雅利安人更是从遥远的西北迁徙而来——有学者认为婆罗门教和佛教中代表光明、生命和清凉的净土位于西方，也许正是来源于对古老故土的一丝追念。

这种本能，即使在国家作为政权形式出现后也依然躁动不已，尽管出于稳定的考虑迁徙在农业社会里往往是被限制甚至禁止的。《诗经·魏风·硕鼠》比较形象地描述了此类限制与反抗之间的斗争——如“逝将去女，适彼乐土”的宣言大概哪个当政者听了都会头疼不止的，而孔圣人的一句“苛政猛于虎也”又为逃离这种用脚投票的方式提供了道义上的正当性。在其后的两千多年里，治下百姓是安居乐业还是相率逃亡，一直是评价当政者德行的一个重要指标。春风化雨的王道方法操作不易，劳心费力，效果也受到诸多条件的限制，将民众与土地硬性捆绑起来的诸多“霸道”制度也就相应而生了。可即使如此，效果仍然不佳，历朝历代逃民逃户都是让治政者挠头的难题。无可奈何之下，大概也只能归结为小民缺乏教化、素质太低——怎么就不知道感戴天恩浩荡呢？！怎么就不知道替父母官想想呢？！这人和人的差距咋就这么大呢？！',
                        'author' => '明窗白尘的世界',
                        'origin' => '旅美散记之(4) 民工！民工！',
                        'origin_date' => '2008/10/25',
                        'show_date' => true,
                        'origin_url' => 'https://windowdust.wordpress.com/2008/10/25/%E6%97%85%E7%BE%8E%E6%95%A3%E8%AE%B0%E4%B9%8B4-%E6%B0%91%E5%B7%A5%EF%BC%81%E6%B0%91%E5%B7%A5%EF%BC%81/',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi2',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '候鸟伴寒暑交替来来去去，人们早司空见惯；北美驯鹿随季节在林地与高原冻土地带间往返，也延续了千百年；非洲草原上，野生动物因应雨季和旱季而进行的大迁徙，其壮观场面如今已经成为了肯尼亚、坦桑尼亚线路旅游的热点。作为万物灵长的人类，意识深处自然也澎湃着这种对生命的渴望。不说以化石和染色体线粒体分析作依据的蒙昧时代走出非洲，就是进入文明纪元后，许多民族的早期记忆里也都保留了迁徙的影子。《圣经》的《出埃及记》中，摩西带领着以色列人穿过红海，最终到达“流奶与蜜的地”迦南；《诗经·大雅》的《生民》、《公刘》、《绵》、《皇矣》、《大明》五篇周民族史诗中，氏族首领也是带领众人一迁再迁；古印度吠陀文化的创立者雅利安人更是从遥远的西北迁徙而来——有学者认为婆罗门教和佛教中代表光明、生命和清凉的净土位于西方，也许正是来源于对古老故土的一丝追念。

这种本能，即使在国家作为政权形式出现后也依然躁动不已，尽管出于稳定的考虑迁徙在农业社会里往往是被限制甚至禁止的。《诗经·魏风·硕鼠》比较形象地描述了此类限制与反抗之间的斗争——如“逝将去女，适彼乐土”的宣言大概哪个当政者听了都会头疼不止的，而孔圣人的一句“苛政猛于虎也”又为逃离这种用脚投票的方式提供了道义上的正当性。在其后的两千多年里，治下百姓是安居乐业还是相率逃亡，一直是评价当政者德行的一个重要指标。春风化雨的王道方法操作不易，劳心费力，效果也受到诸多条件的限制，将民众与土地硬性捆绑起来的诸多“霸道”制度也就相应而生了。可即使如此，效果仍然不佳，历朝历代逃民逃户都是让治政者挠头的难题。无可奈何之下，大概也只能归结为小民缺乏教化、素质太低——怎么就不知道感戴天恩浩荡呢？！怎么就不知道替父母官想想呢？！这人和人的差距咋就这么大呢？！',
                        'author' => '明窗白尘的世界',
                        'origin' => '旅美散记之(4) 民工！民工！',
                        'origin_date' => '2008/10/25',
                        'show_date' => true,
                        'origin_url' => 'https://windowdust.wordpress.com/2008/10/25/%E6%97%85%E7%BE%8E%E6%95%A3%E8%AE%B0%E4%B9%8B4-%E6%B0%91%E5%B7%A5%EF%BC%81%E6%B0%91%E5%B7%A5%EF%BC%81/',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi2',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '家乡的牛群。 ​​​​此心安处是吾乡。除北京以外，在哪里住久了都有家乡有感觉。这大概就是人们有时候会说的第二故乡吧。 ',
                        'author' => '老刘在德克萨斯',
                        'origin' => null,
                        'origin_date' => '2017/05/26',
                        'show_date' => true,
                        'origin_url' => 'http://weibo.com/5660114886/F4OXdoWeS',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi2',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '即便没有读过多少书，只是基于自由人常识，向往一种充满创造力的、给人自由自主空间的文明，比固守一种按远近亲疏高低贵贱搞人身依附、分级压迫本族弱者的传统，更有出息。',
                        'author' => '老刘在德克萨斯',
                        'origin' => null,
                        'origin_date' => '2017/05/22',
                        'show_date' => true,
                        'origin_url' => 'http://weibo.com/5660114886/F4fwtbrZw',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi3',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '在一个是非颠倒的扯淡囶度，让我再选择一遍人生，我仍然会像有出息的中华先民那样「逝将去汝，适彼乐土」。世上有很多无可奈何的事，但底线是做个有尊严的自由人。只要不用为生计不得不去附和那些自我感觉重于泰山的沐猴而冠的才俊，即便生命轻若鸿毛，浮萍般漂泊，也是一种值得过的人生。 ',
                        'author' => '老刘在德克萨斯',
                        'origin' => null,
                        'origin_date' => '2017/05/22',
                        'show_date' => true,
                        'origin_url' => 'http://weibo.com/5660114886/F4fEAoaTQ',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'yi5',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 5,

                        'body' => '「移民是人生的选择(life choice)而不是职业的选择(career choice)。」移民与否实际上是生活方式的选择，不但是选择自己的生活方式，更是为自己的孩子(以及那些未出生的后代)选择生活方式。移民到底值不值？这要看你如何定义“值”以及对谁而言。如果成功，权力和金钱是你的追求，移民也许不值，在国内可能会更成功；如果生活方式是你的追求，也许就是另外一种回答。让自己和孩子们能呼吸到干净的空气，能更自由地成长，说自己想说的话，做自己想做的事情，这当然就值了。',
                        'author' => '白露为霜',
                        'origin' => null,
                        'origin_date' => '2014/10/06',
                        'show_date' => true,
                        'origin_url' => 'http://www.sinovision.net/home.php?mod=space&do=blog&uid=163286&id=237633',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ],
            ],
            [
                'slug' => 'do-with-children-mistakes',
                'articleable_id'=>$column_id,'title' => '如果我们指出孩子的错误',
                'desc'=>'在每天练琴时，我不再直接指出女儿的错误。',
                'intro' => '我：「你刚才那个音拉错了！」<br>女：「没有，我拉的是对的！」<br>我：「不信你看我给你录的录像！」<br>女：「就没拉错，就没拉错！」<br>这曾经是每天晚上当五岁的女儿练习小提琴时发生在我家里的对话。每一次对话的结局都是女儿气呼呼地扔下琴离开，剩下我自己面对满腔的怒火不知怎样发泄。 ',
                'author' => '两个宝贝',
                'origin' => '<z-wechat data-id="yuerxianyuxin">育儿先育心</z-wechat>',
                'origin_date' => '2017-04-05',
                'show_date' => true,
                'origin_url' => 'http://mp.weixin.qq.com/s/-uZtJLI7iQTKW3UoGZOnFA',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/06/20',
                'comment' => '',
                '_place' => [
                    'name' => '波士顿',
                    'name_en' => 'Boston',
                    'addr' => 'MA',
                    'lat' => 42.3132882,
                    'lng' => -71.1972432,
                    'info' => [
                        'intro' => '*How Children Learn* (1967; revised 1983)。作者 John Holt(1923～1985)， 他的多部作品极大影响了 unschooling 运动.',
                        'relation' => false,
                    ]
                ],
                '_quotes' => [

                    [
                        '_slug' => 'cuowu1',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '孩子在写《妈妈，我想对你说》这篇作文的时候，他一定是有感于妈妈这几天对自己的鼓励和认可，而在作文中对妈妈表达出了深深的爱，他期待妈妈在看完这篇文章之后，能够真正体会到自己写作文时的心情，能够被作文感动，能够抱着自己，看着自己的眼睛，温柔的对自己说：「好孩子，你写的很好，妈妈好感动，妈妈一定会更加努力，让我的宝贝幸福快乐。」  
但是，他得到的是一句简单的：「写的不错，但是，有几个错别字。」在孩子眼中，自己饱含感情写的这篇作文，在妈妈的眼中，还没有几个错别字的重要性大。  
教育孩子，但是“错别字”这个词不要说，只要一说，那么，但是之前你说的所有有用的话，都等于没说。  
只要孩子爱上写作，他会看许多书籍，他的错别字和病句都会随着他的热爱与兴趣慢慢消失。  
更何况，即使在老师改卷评分的时候，一两个错别字扣分，根本影响不了老师因为这篇文章流露出的真情实感而动容给的高分。文章首先要情感丰沛，其次才是遣词造句。',
                        'author' => '一位家长',
                        'origin' => '《从作文中的错别字要不要改说起》',
                        'origin_date' => '2014/04/04',
                        'show_date' => true,
                        'origin_url' => '//blog.sina.com.cn/s/blog_54377c2a0101cjiv.html',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'cuowu2',
                        'type' => 'tail',
                        'order' => 2,

                        'body' => '晚上看见一小朋友骑小自行车玩，骑得稍快，转弯时不小心撞到妈妈。妈妈马上沉下脸说“你怎么撞妈妈呢？！”孩子瞬间不知所措，然后在妈妈要求下道歉，一脸迷惑和羞愧。成年人阴暗地看待孩子，无意识地欺负孩子，孩子的心理和道德就这样悄悄地被损坏了。

儿童需要的是理解宽容善待。妈妈一笑了之是最好的处理，甚至“小心点”都可以免说。

成年人的眼光决定儿童的自我价值感。妈妈生气，孩子会立即对自己做出负面评价，失误就是差劲，就是对他人不敬；如果妈妈给予宽容，孩子就会对失误有正面认识，动作上会自动改进，心理上也积淀一份爱和自信——这就是伪说教和真爱的区别，正是这些细节决定了教育的走向。',
                        'author' => '尹建莉',
                        'origin' => '《从作文中的错别字要不要改说起》',
                        'origin_date' => '2015/08/26',
                        'show_date' => true,
                        'origin_url' => '//weibo.com/1412922410/CxBZGBphT',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ],
//                        '_place'=>[
//                            'name' => '内蒙古武川县',
//                            'name_en' => '',
//                            'addr' => '',
//                            'address' =>'',
//                            'lat' => 41.0480226,
//                            'lng' => 110.9043124,
//                            'comment'=>'',
//                        ],
                '_vol' => [
                    'title' => '孩子的错',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_brothers' => [
                    [
                        'slug' => 'childhood-needs-trial-error-disobedience',
                        'articleable_id'=>$column_id,'title' => '童年需要“试误”和“不听话” ',
                        'intro' => '我们允许她在同一件事上犯两次甚至更多次错误，我们坚信，没有哪一次错误是白犯的，即使相同的错误，每一次的收获也是不一样的。圆圆从小就显得非常懂事，很有主见。不允许孩子犯错误，要孩子事事听命于家长，这犹如不允许学走路的孩子摔跤一样，是以暂时的、表面的完美取代长久的、内在的完善。',
                        'desc' => '我们允许她在同一件事上犯两次甚至更多次错误，我们坚信，没有哪一次错误是白犯的，即使相同的错误，每一次的收获也是不一样的。圆圆从小就显得非常懂事，很有主见。',
                        'author' => '尹建莉',
                        'type'=>'first',
                        'origin' => '<z-wechat data-id="yinjianligongzuoshi">父母学堂</z-wechat>',
                        'origin_date' => '2016-01-14',
                        'show_date' => true,
                        'origin_url' => '//mp.weixin.qq.com/s/Z6F61r8eFSd-k7Oim3YBbA',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                        'comment' => '',
                        '_quotes' => [

                        ],
//                        '_place'=>[
//                            'name' => '内蒙古武川县',
//                            'name_en' => '',
//                            'addr' => '',
//                            'address' =>'',
//                            'lat' => 41.0480226,
//                            'lng' => 110.9043124,
//                            'comment'=>'',
//                        ],
                    ],
                    [
                        'slug' => 'meet-to-give-advice-weekly',
                        'articleable_id'=>$column_id,'title' => '每周开个「提意见会」',
                        'desc' => '「提意见会」的价值不在于改造孩子，在于让孩子郑重其事地获得表达权，并且感受到交流方式的重要性。',
                        'intro' => '「提意见会」的价值不在于改造孩子，在于让孩子郑重其事地获得表达权，并且感受到交流方式的重要性。',
                        'author' => '尹建莉',
                        'origin' => '<z-wechat data-id="yinjianligongzuoshi">父母学堂</z-wechat>',
                        'origin_date' => '2016-01-14',
                        'show_date' => true,
                        'origin_url' => '//mp.weixin.qq.com/s/Z6F61r8eFSd-k7Oim3YBbA',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                        'comment' => '',
                        '_quotes' => [

                        ],
//                        '_place'=>[
//                            'name' => '内蒙古武川县',
//                            'name_en' => '',
//                            'addr' => '',
//                            'address' =>'',
//                            'lat' => 41.0480226,
//                            'lng' => 110.9043124,
//                            'comment'=>'',
//                        ],
                    ],
                    [
                        'slug' => 'see-and-let-go',
                        'articleable_id'=>$column_id,'title' => '看见，放手',
                        'desc' => '只要我妈妈交代我做什么事情，我就一定会故意拖延。',
                        'intro' => '只要我妈妈交代我做什么事情，我就一定会故意拖延。',
                        'author' => '布尔费墨',
                        'origin' => '',
                        'origin_date' => '2017-04-13',
                        'show_date' => true,
                        'origin_url' => 'http://weibo.com/ttarticle/p/show?id=2309404095892192951527',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                        'comment' => '',
                        '_quotes' => [

                        ],
//                        '_place'=>[
//                            'name' => '内蒙古武川县',
//                            'name_en' => '',
//                            'addr' => '',
//                            'address' =>'',
//                            'lat' => 41.0480226,
//                            'lng' => 110.9043124,
//                            'comment'=>'',
//                        ],
                    ],
                ],
            ],
        ]);

        $articles =
            array_merge($articles, [
                [
                    'slug' => "this-is-mine",
                    'articleable_id'=>$column_id,'title' => '「这是我的」',
                    'desc' => '孩子怎么越来越自私了，什么都不让别人动，动不动就说「这是我的这是我的」。实际上这跟自私毫无关系，儿童是通过占有属于自我的东西来区分自己和他人的。',
                    'intro' => '孩子怎么越来越自私了，什么都不让别人动，动不动就说「这是我的这是我的」。实际上这跟自私毫无关系，儿童是通过占有属于自我的东西来区分自己和他人的。',
                    'author' => '王晓燕',
                    'origin' => '《捕捉儿童敏感期》第2版',
                    'origin_date' => '2010-01-01',
                    'show_date' => false,
                    'origin_url' => '',
                    'copyright' => '',
                    'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                    'created_at' => '2017/06/19',
                    'comment' => '',
                    '_vol' => [
                        'title' => '财产权、自我',
                        'column_id' => $column_id,
                        'no' => ++$column_no_start,
                        'person_id' => null,
                    ],
                    '_brothers' => [
                        [
                            'slug' => 'self-birth',
                            'articleable_id'=>$column_id,'title' => '自我的诞生',
                            'intro' => '0-6 岁的儿童是以自我为中心的。如果没有这样的激情和全部的投入，婴儿就永远无法形成自我，最后也无法走出自我。',
                            'desc' => '0-6 岁的儿童是以自我为中心的。如果没有这样的激情和全部的投入，婴儿就永远无法形成自我，最后也无法走出自我。',
                            'author' => '孙瑞雪',
                            'origin' => '《捕捉儿童敏感期》第2版',
                            'origin_date' => '2010-01-01',
                            'show_date' => false,
                            'origin_url' => '',
                            'copyright' => '',
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                            'comment' => '',
                            '_quotes' => [

                            ],
//                        '_place'=>[
//                            'name' => '内蒙古武川县',
//                            'name_en' => '',
//                            'addr' => '',
//                            'address' =>'',
//                            'lat' => 41.0480226,
//                            'lng' => 110.9043124,
//                            'comment'=>'',
//                        ],
                        ],
                    ],
                    '_place' => [
                        'name' => '时代廊桥幼儿园',
                        'name_en' => '',
                        'addr' => '广州',
                        'address' => '',
                        'lat' => 23.0682177,
                        'lng' => 113.3014496,
                        'url' => 'http://www.love-freedom.com/index.php?c=school&a=sabout&id=127&pid=117',
                        'comment' => '',
                    ],
//                '_tags'=>['孝'],
                    '_quotes' => [

                        [
                            '_slug' => 'zisi1',
                            'quoteable_type' => 'Article',
                            'type' => 'tail',
                            'order' => 1,

                            'body' => '有些家长深谙吃亏是福的道理，也希望培养孩子无私的品格，遇到孩子和别的小朋友抢东西时，总是要求自己的孩子出让，这种做法也不对，也是走极端了。

因为自私是人的天性，就像卢梭说的那样：我们原始的情感是以自我为中心的；我们所有的一切本能的活动首先是为了保持自身的生存和自身的幸福。所以，第一个正义感不是产生于我们怎样对别人，而是产生于别人怎样对我们。一般的教育方法有一个错误就是：首先对孩子们只讲他们的责任，而从来不谈他们的权利，所以开头就颠倒了。

幼儿尚未建立合作的概念，自己的玩具不让别的小朋友玩，或抢别人的玩具，这都是正常表现。强迫孩子出让自己的利益，这种做法并不能培养孩子的大度精神，反而强化他的紧张感。如果一个孩子感觉别人总是侵犯他的私人领空，干涉他的事情，他会变得特别警惕，表现得更自私。',
                            'author' => '尹建莉',
                            'origin' => '《家长采用“三不原则”,孩子学会和小伙伴相处》',
                            'origin_date' => null,
                            'show_date' => false,
                            'origin_url' => '',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                ],
                [
                    'slug' => "power-causes-brain-damage",
                    'articleable_id'=>$column_id,'title' => '权力导致脑损伤',
                    'intro' => '神经科学研究：掌握权力会导致脑损伤，领导者失去设身处地理解他人的能力。',
                    'desc' => '神经科学研究：掌握权力会导致脑损伤，领导者失去设身处地理解他人的能力。',
                    'author' => '杰瑞·尤西姆 译：格格太多',
                    'origin' => '《大西洋月刊》 2017年7/8月',
                    'origin_date' => '2017/11/26',
                    'show_date' => false,
                    'origin_url' => 'http://www.jianshu.com/p/bd1d7beef1a5',
                    'copyright' => '',
                    'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                    'created_at' => '2017/12/13',
                    'comment' => '',
                    '_vol' => [
                        'title' => '权力',
                        'column_id' => $column_id,
                        'no' => ++$column_no_start,
                        'person_id' => null,
                    ],
                    '_brothers' => [
                    ],
                    '_place' => [
                        'name' => '委内瑞拉总统府',
                        'name_en' => 'State House',
                        'lat' => -17.812124,
                        'lng' => 31.0557677,
                        'info' => [
                            'title' => '93 岁穆加贝：「自己的身体状况能够继续胜任总统」。',
                            'intro' => '委内瑞拉曾是非洲粮仓，但畸形制度等来经济下滑时，穆加贝集团为把持政权实行地产掠夺和计划经济，带来严重饥荒，当时「南丰捐送了 15 万个裹尸袋」（[津巴布韦，为什么会发生大饥荒| 短史记](http://mp.weixin.qq.com/s/630gQEw8AqcV7cRwTYnEwA)），同时，委内瑞拉跻身世界上属于最腐败的国家行列，至少2万亿美元的财富被侵吞。穆加贝一头黑发，不幸的是，还没「死而后已」就来了委版的「粉碎四人帮」（[穆加比、曼德拉](https://www.msn.com/zh-tw/news/world/閻紀宇專欄穆加比、毛澤東、曼德拉/ar-BBFp6cD)）。',
                            'relation' => false,
                        ]
                    ],
//                '_tags'=>['孝'],
                    '_quotes' => [

                    ],
                ],
            ]);


        // ren
        $create_time = $create_time + 1000;
        $column_no_start = 0;
        $column_id = $ren_id;
        $articles = array_merge($articles, [
            [
                'slug' => 'take-baby-on-bus-nobody-offer-seat',
                'articleable_id'=>$column_id,'title' => '抱小孩坐公交没人给让座，我是这么干的',
                'desc' => '家长是孩子的第一任老师。当年幼的孩子在看到自己的母亲独立面对问题，在处理这些小事上的积极态度。耳濡目染，也会慢慢地学会照顾自己，为自己负责。',
                'intro' => '家长是孩子的第一任老师，他们的言行、动作都是孩子学习的榜样。当年幼的孩子在看到自己的母亲独立面对问题，在处理这些小事上的积极态度。耳濡目染，也会慢慢地学会照顾自己，为自己负责。',
                'author' => '舒馨',
                'origin' => '尹建莉父母学堂',
                'origin_date' => '2017-08-07',
                'show_date' => false,
                'origin_url' => 'https://mp.weixin.qq.com/s/AqaMhXPSgWGdza5Vf95-8w',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/05/03',
                'comment' => '',
                '_place' => [
                    'name' => '北京东直门',
                    'lat' => 39.941193,
                    'lng' => 116.4315023,
                    'info' => [
                        'intro' => '法律规定，盲人可免费乘坐地铁。而盲人陈先生在北京乘地铁时，却被拒绝进站。地铁站站长表示：必须有本地盲人乘车证，不然就得买票。',
                        'relation' => true,
                    ]
                ],
                '_vol' => [
                    'title' => 'me',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],

            ],
            [
                'slug' => 'On-Children',
                'articleable_id'=>$column_id,'title' => '孩子',
                'desc' => '你的孩子不属于你 他们是生命的渴望是生命自己的儿女 经由你来到世上与你相伴 却有自己独立的轨迹',
                'intro' => 'They come through you but not from you.你的孩子不属于你 他们是生命的渴望是生命自己的儿女 经由你来到世上与你相伴 却有自己独立的轨迹',
                'author' => '卡里·纪伯伦（Kahlil Gibran）',
                'origin' => 'The Prophet . 1923',
                'origin_date' => '1923/01/01',
                'show_date' => false,
                'origin_url' => 'https://allpoetry.com/Children-Chapter-IV',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/06/03',
                'comment' => '',
                '_place' => [
                    'name_en' => 'Bsharri',
                    'addr' => 'Lebanon',
                    'address' => '',
                    'lat' => 34.2506498,
                    'lng' => 35.9942225,
                    'info' => [
                        'intro' => 'Gibran 成长在奥斯曼帝国时代的山区中（今黎巴嫩），12 岁和母亲离开家乡',
                        'relation' => false,
                    ]
                ],
                '_vol' => [
                    'title' => 'on children',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],

                '_brothers' => [
//                    [
//                        'slug' => '父母之爱是个逐渐分离的过程',
//                        'articleable_id'=>$column_id,'title' => '父母之爱是个逐渐分离的过程',
//                        'intro' => '有一天，小四失踪了，只给媳妇留了一张六个字的纸条，「我走了，不用找」。二十多年过去了，小四再没出现。每每想到小四，那个我们童年的玩伴，想到他小时候天真无邪的淘气样，以及 25 岁时绝诀的离去，我都惆怅万分，叹息母爱可能是一座宫殿，也可能是一间牢狱',
//                        'author' => '',
//                        'origin' => '《最美的教育最简单》2014.8',
//                        'origin_date' => '2006/10/01',
//                        'show_date' => false,
//                        'origin_url' => 'http://blog.sina.com.cn/s/blog_54377c2a0102xie6.html',
//                        'copyright' => '',
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                        'comment' => '',
//                        '_place'=>[
//                            'name' => '内蒙古武川县',
//                            'name_en' => '',
//                            'addr' => '',
//                            'address' =>'',
//                            'lat' => 41.0480226,
//                            'lng' => 110.9043124,
//                            'comment'=>'',
//                        ],
//                    ],

                ],
//                '_note' => [
//                    '_slug' => '',
//                    'slug' => '',
//                    'articleable_id'=>$column_id,'title' => '',
//                    'intro' => '',
//                    'author' => '结巢人境',
//                    'author_id' => 1,
//                    'created_at' => '2016/09/03',
//
//                    'status' => 1, 'deep' => 'open',
//                    'comment' => '',
//                ],
            ],
//            [
//                'slug' => "",
//                'articleable_id'=>$column_id,'title' => '伯通：不要做中国人的孩子
//
//                得了“厌童症”的大人们，请宽容人类自己
//                https://mp.weixin.qq.com/s/0sPmYdsUK575p6TvnY5LMQ
//                父母带礼物上飞机请求同机乘客包容孩子可能出现的吵闹，这一类的鸡汤故事，之所以大受欢迎，乃是因为这类故事，消解了成年人包容儿童的道德义务，这种消解方式如此温情脉脉，以至于无人察觉这类鸡汤的流行，实际上造就了一种道德上的大退步。
//               http://weibo.com/1179397731/F5MACz17K?ref=home&rid=9_0_8_3071540767903537418&type=comment
//
//
//                ',
//                'intro' => '',
//                'author' => '刘云枫',
//                'origin' => '',
//                'origin_date' => '2010-12-22',
//                'show_date' => true,
//                'origin_url' => 'http://blog.creaders.net/u/8399/201407/185781.html',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                'comment' => '',
//                '_vol' => [
//                    'title' => '移',
//                    'column_id'=> $column_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
//                '_place' => [
//                    'name' => '上海英美租界会审公廨（北浙江路）',
//                    'name_en' => '',
//                    'addr' => '',
//                    'address' => '',
//                    'lat' => 31.244831,
//                    'lng' => 121.475756,
//                    'comment' => '光绪二十五年八月十四日（1899年9月18日）迁至北浙江路七浦路口新址的会审公廨。//之前：同治八年三月初九（1869年4月20日）公布生效，总理衙门和公使团核准实施，会审公廨正式成立。 当时，原定《洋泾浜设官会审章程》有效期仅1年，但自颁布后，该章程一直沿用。会审公廨最初位于南京路洋泾浜北首理事衙门原址，光绪八年（1882年）迁到南京路口菜市街对面',
//                ],
////                '_tags'=>['孝'],
//                '_quotes' => [
//
//                    [
//                        '_slug' => 'yi0',
//                        'quoteable_type' => 'Article',
//                        'type' => 'tail',
//                        'order' => 1,
//
//                        'body' => 'Where liberty dwells, there is my country.',
//                        'author' => 'Benjamin Franklin',
//                        'origin' => '',
//                        'origin_date' => null,
//                        'show_date' => false,
//                        'origin_url' => '',
//                        'origin_tip' => null,
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'comment' => '',
//                    ],
//                    [
//                        '_slug' => 'yi2',
//                        'quoteable_type' => 'Article',
//                        'type' => 'tail',
//                        'order' => 1,
//
//                        'body' => '家乡的牛群。 ​​​​此心安处是吾乡。除北京以外，在哪里住久了都有家乡有感觉。这大概就是人们有时候会说的第二故乡吧。 ',
//                        'author' => '老刘在德克萨斯',
//                        'origin' => null,
//                        'origin_date' => '2017/05/26',
//                        'show_date' => true,
//                        'origin_url' => 'http://weibo.com/5660114886/F4OXdoWeS',
//                        'origin_tip' => null,
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'comment' => '',
//                    ],


//                ],
//            ],
//            [
//                'slug' => "lab-animal-monuments",
//                'articleable_id'=>$column_id,'title' => '实验动物纪念碑和对生命的态度',
//                'intro' => '',
//                'author' => '',
//                'origin' => '',
//                'origin_date' => '2010-12-22',
//                'show_date' => true,
//                'origin_url' => 'http://blog.creaders.net/u/8399/201407/185781.html',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                'comment' => '',
//                '_vol' => [
//                    'title' => '移',
//                    'column_id'=> $column_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
//                '_place' => [
//                    'name' => '上海英美租界会审公廨（北浙江路）',
//                    'name_en' => '',
//                    'addr' => '',
//                    'address' => '',
//                    'lat' => 31.244831,
//                    'lng' => 121.475756,
//                    'comment' => '光绪二十五年八月十四日（1899年9月18日）迁至北浙江路七浦路口新址的会审公廨。//之前：同治八年三月初九（1869年4月20日）公布生效，总理衙门和公使团核准实施，会审公廨正式成立。 当时，原定《洋泾浜设官会审章程》有效期仅1年，但自颁布后，该章程一直沿用。会审公廨最初位于南京路洋泾浜北首理事衙门原址，光绪八年（1882年）迁到南京路口菜市街对面',
//                ],
////                '_tags'=>['孝'],
//                '_quotes' => [
//
//                    [
//                        '_slug' => 'yi0',
//                        'quoteable_type' => 'Article',
//                        'type' => 'tail',
//                        'order' => 1,
//
//                        'body' => 'Where liberty dwells, there is my country.',
//                        'author' => 'Benjamin Franklin',
//                        'origin' => '',
//                        'origin_date' => null,
//                        'show_date' => false,
//                        'origin_url' => '',
//                        'origin_tip' => null,
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'comment' => '',
//                    ],
//                ],
//            ],

            [
                'slug' => "human-civilizations-come-dripping--every-pore-with-blood-and-dirt",
                'articleable_id'=>$column_id,'title' => '人类文明来到世间，「从头到脚，每个毛孔都滴着血和肮脏的东西」',
                'desc' => '人类起于野蛮，在人类文明长河的多数时段和地域，人的历史一直是一部人吃人的历史',
                'intro' => '当一个族群在文化与科技方面稍领先一点（哪怕仅领先几十年）往往就会倾向于用战争手段征服与劫掠邻居…远古如亚述，历史上第一个拥有了铁兵器军队，立刻就将其四邻变成「鲜血浸透的地方」。',
                'author' => '结巢人境（编）',
                'author_id' => 1,
                'origin' => '',
                'origin_date' => '2010/03/01',
                'show_date' => false,
                'origin_url' => '',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/06/15',
                'comment' => '',
                '_vol' => [
                    'title' => '人类文明 恶',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => '尼姆鲁德',
                    'name_en' => 'Nimrud',
                    'addr' => '',
                    'lat' => 36.065797,
                    'lng' => 43.2618086,
                    'comment' => '亚述古城,在伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔南约30公里处',
                    'info' => [
                        'intro' => '亚述古城，纳西尔帕二世迁都至此。邻近今天的伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔。',
                    ]
                ],
                '_quotes' => [

                    [
                        '_slug' => 'blood_self',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 1,

                        'body' => '萨特说：他人即地狱…不同个体权利之间，永远存在冲突；所以，必须清晰划定“群己权界”；且这与 Democracy or despotism 与否无关，哪怕最自由状态下，若无个体之间-个体与群体之间的权利界限，那么任何人随时随地可能成为你的地狱…譬如：强灌你酒的、交通纠纷私了、办公室人事…都可能是你的地狱。 ​​​​ 

西人的“自由”，其实是以法律形式界定群己权界（这是西方文明最大贡献之一）没有法律就没有自由，是美帝小学教育必讲一课。<z-deep>而中华文化对自由的认识是：想干啥就干啥，想咋干就咋干；而法律更是产权不清；所以，民众普遍很怕“自由”；而权贵还真是想干啥就干啥，想咋干就咋干！ </z-deep> ',
                        'author' => '美利坚07',
                        'origin' => null,
                        'origin_date' => '2016-8-6',
                        'show_date' => true,
                        'origin_url' => 'http://weibo.com/5527193038/E2jRZpz35',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    [
                        '_slug' => 'blood_self',
                        'quoteable_type' => 'Article',
                        'type' => 'tail',
                        'order' => 2,

                        'body' => '能成为太空任务专家的，一定是人中翘楚，当一群精英生活在与地球不同的空间相当长时间后，自然而然就会与普通民众逐渐隔阂、最终甚至相互敌对…看看德意志：人群里精英较多后，就想去“消灭劣等族群”，再看看美利坚，就算不去消灭“劣等族群”，别人也会嫉恨之…这是人性。

互相看不顺眼怎么办？打。这是人类本性…暂时不打，是因没算准是否能打赢；一旦“庙算”后觉得自己能占便宜，就会出手，譬如韩战：真打起来才发现，嚓！算错了…而穷人一旦绝望后，连算都不算就会下死手；50年后，这世界110亿人至少100亿穷人，排放更多、海平面上涨更快、失去耕地更多。 

当未来世界的人口超越环境与资源阈值后，多数人沉浸在贫瘠-肮脏-犯罪-混乱-愤懑中；就会有越来越多“<z-deep>洪秀全-列宁-</z-deep>希特勒-Mxx-本拉登-巴格达迪”式领袖提出最能煽动贫民的“解决方案”；富人如何应对？他们会雇佣精英战士，用Ai操控无人战斗机械狂轰滥炸…

这个游戏模式人类玩了5000年，改变的只是武器部分…就像《帝国时代》不断装备升级一般，以后还会这样反复延续；我们在历史长河中，连一粒微尘的资格都不够。//@Moses003:打土豪，分女人，未来领袖的政治纲领。


                        ',
                        'author' => '美利坚07',
                        'origin' => null,
                        'origin_date' => '2017-7-15',
                        'show_date' => true,
                        'origin_url' => '//weibo.com/5527193038/FcsSCwUD6',
                        'origin_tip' => null,
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                ],
//                '_tags'=>['孝'],
                '_brothers' => [
                    [
                        'slug' => "human-civilizations-come-dripping--every-pore-with-blood-and-dirt-2",
                        'articleable_id'=>$column_id,'title' => '《人类文明来到世间》之二：没有杀戮就没有新帝国',
                        'desc' => '耶酥会士卫匡国( Martin Martini )在《鞑靼战纪》中记述:「他们不论男女老幼一律残酷地杀死，他们不说别的，只说:『杀！杀死这些反叛的蛮子!』」这就是一个新帝国崛起的场景。',
                        'intro' => '耶酥会士卫匡国( Martin Martini )在《鞑靼战纪》中记述:「他们不论男女老幼一律残酷地杀死，他们不说别的，只说:『杀！杀死这些反叛的蛮子!』」这就是一个新帝国崛起的场景。',
                        'author' => '结巢人境（编）',
                        'author_id' => 1,
                        'origin' => '',
                        'origin_date' => '2010/03/01',
                        'show_date' => false,
                        'origin_url' => '',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => '2017/06/15',
                        'comment' => '',
//                        '_place' => [
//                            'name' => '尼姆鲁德',
//                            'name_en' => 'Nimrud',
//                            'addr' => '',
//                            'lat' => 36.065797,
//                            'lng' => 43.2618086,
//                            'comment' => '亚述古城,在伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔南约30公里处',
//                            'info' => [
//                                'intro' => '亚述古城，纳西尔帕二世迁都至此。邻近今天的伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔。',
//                            ]
//                        ],
                        '_quotes' => [

                        ],
//                '_tags'=>['孝'],
                    ],
                    [
                        'slug' => "human-civilizations-come-dripping--every-pore-with-blood-and-dirt-3",
                        'articleable_id'=>$column_id,'title' => '《人类文明来到世间》之三：领土没有「自古以来」',
                        'desc' => '越南独立后，持续采取「北守南攻」战略，持续８００年的侵略，使扩张的领土面积达到独立时的四倍，具有古老文明的占城国灭亡、柬埔寨缩小了一半。',
                        'intro' => '越南独立后，持续采取「北守南攻」战略，持续８００年的侵略，使扩张的领土面积达到独立时的四倍，具有古老文明的占城国灭亡、柬埔寨缩小了一半。',
                        'author' => '结巢人境（编）',
                        'author_id' => 1,
                        'origin' => '',
                        'origin_date' => '2010/03/01',
                        'show_date' => false,
                        'origin_url' => '',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => '2017/06/15',
                        'comment' => '',
//                        '_place' => [
//                            'name' => '尼姆鲁德',
//                            'name_en' => 'Nimrud',
//                            'addr' => '',
//                            'lat' => 36.065797,
//                            'lng' => 43.2618086,
//                            'comment' => '亚述古城,在伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔南约30公里处',
//                            'info' => [
//                                'intro' => '亚述古城，纳西尔帕二世迁都至此。邻近今天的伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔。',
//                            ]
//                        ],
                        '_quotes' => [

                        ],
//                '_tags'=>['孝'],
                    ],
                    [
                        'slug' => "human-civilizations-come-dripping--every-pore-with-blood-and-dirt-4",
                        'articleable_id'=>$column_id,'title' => '《人类文明来到世间》之四：有国就有家吗',
                        //todo 美国校园枪击案
                        'intro' => '封疆大吏上书皇帝：英军总是用小恩小惠巴结老百姓，老百姓一点不怕英军，倒是怕咱们官军，跟咱不是一条心啊！',
                        'desc' => '有国不一定有安全的家，有国不一定有安全的你。',
                        'author' => '结巢人境（编）',
                        'author_id' => 1,
                        'origin' => '',
                        'origin_date' => '2010/03/01',
                        'show_date' => false,
                        'origin_url' => '',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => '2017/06/15',
                        'comment' => '',
//                        '_place' => [
//                            'name' => '尼姆鲁德',
//                            'name_en' => 'Nimrud',
//                            'addr' => '',
//                            'lat' => 36.065797,
//                            'lng' => 43.2618086,
//                            'comment' => '亚述古城,在伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔南约30公里处',
//                            'info' => [
//                                'intro' => '亚述古城，纳西尔帕二世迁都至此。邻近今天的伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔。',
//                            ]
//                        ],
                        '_quotes' => [

                        ],
//                '_tags'=>['孝'],
                    ],
                    [
                        'slug' => "human-civilizations-come-dripping--every-pore-with-blood-and-dirt-5",
                        'articleable_id'=>$column_id,'title' => '《人类文明来到世间》之五：人类进步的起点 是不信奉『存在即合理』',
                        'intro' => '19 世纪末，美国遭遇空前的经济危机，失业人口第一次突破 300 万。为了缓解这场危机，美国决策层发动抢夺殖民地的战争，如果按照这个套路发展，美国可能会成为日本、德国以及亚述、埃及、波斯、罗马、蒙古、奥斯曼、俄罗斯、大金国、越南、日本那般的扩张型国家。',
                        'desc'=>'为什么年轻的美囶停止扩张，不学习亚述、埃及、波斯、罗马、蒙古、奥斯曼、俄罗斯、大金国、越南、日本？',
                        'author' => '结巢人境（编）',
                        'author_id' => 1,
                        'origin' => '',
                        'origin_date' => '2010/03/01',
                        'show_date' => false,
                        'origin_url' => '',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => '2017/06/15',
                        'comment' => '',
                        '_place' => [
                            'name' => '尼姆鲁德',
                            'name_en' => 'Nimrud',
                            'addr' => '',
                            'lat' => 36.065797,
                            'lng' => 43.2618086,
                            'comment' => '亚述古城,在伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔南约30公里处',
                            'info' => [
                                'intro' => '亚述古城，纳西尔帕二世迁都至此。邻近今天的伊拉克第二大城市、“伊斯兰国”主要据点摩苏尔。',
                            ]
                        ],
                        '_quotes' => [

                        ],
//                '_tags'=>['孝'],
                    ],
                    [
                        'slug' => "China-origin-expansion",
                        'articleable_id'=>$column_id,'title' => '中华的起源和早期扩张',
                        'desc' => '周是被商王征服的盟邦，如同中华历代王朝的很多边疆族群，周人并不甘于奴役。',
                        'intro' => '商代一出现经济危机。西部的人口、财富就是他们掠夺的对象，是支撑统治的重要资源**。商代与周人及在更西边的民族例如羌方等常有掠夺性战争爆发，且是单向的。西部人少力薄的部落一直不是有着完整军阵以及雄厚实力的东方大国的对手。',
                        'author' => '结巢人境（编）',
                        'author_id' => 1,
                        'origin' => '',
                        'origin_date' => '2010/03/01',
                        'show_date' => false,
                        'origin_url' => '',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'deep',
                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                        'comment' => '',
                        '_place' => [
                            'name' => '上海英美租界会审公廨（北浙江路）',
                            'name_en' => '',
                            'addr' => '',
                            'address' => '',
                            'lat' => 31.244831,
                            'lng' => 121.475756,
                            'comment' => '光绪二十五年八月十四日（1899年9月18日）迁至北浙江路七浦路口新址的会审公廨。//之前：同治八年三月初九（1869年4月20日）公布生效，总理衙门和公使团核准实施，会审公廨正式成立。 当时，原定《洋泾浜设官会审章程》有效期仅1年，但自颁布后，该章程一直沿用。会审公廨最初位于南京路洋泾浜北首理事衙门原址，光绪八年（1882年）迁到南京路口菜市街对面',
                        ],
//                '_tags'=>['孝'],
                    ],
                ],
            ],
            [
                'slug' => "great-zouzhe-China",
                'articleable_id'=>$column_id,'title' => '中囶历史上的伟大奏折',
                'desc' => '短短八百余字的周馥奏折从人的尊严、奴隶的苦难、文明各囶的立法、天下公理、中囶古法等多个侧面阐述了禁革买卖人口的重要性',
                'intro' => '租界外国巡捕见一中年女子带着数量庞大的幼年女子，怀疑涉嫌人口拐卖，遂将其带回捕房协助调查，后起诉至 Mixed Court（会审公廨，也称会审公堂，中外双方共同审理涉及华人的案件，其成立背景是大量中囶人涌入上海租界避难，华人成为租界多数居民，「华洋分居」被打乱）。',
                'author' => '周永坤',
                'order' => 1,
                'origin' => '《北方法学》2010年第3期',
                'origin_date' => '2010/03/01',
                'show_date' => false,
                'origin_url' => '',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'created_at' => '2017/06/18',
                'comment' => '',
                '_vol' => [
                    'title' => '奴隶',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => '上海英美租界会审公廨（北浙江路）',
                    'name_en' => '',
                    'addr' => '',
                    'address' => '',
                    'lat' => 31.244831,
                    'lng' => 121.475756,
                    'comment' => '光绪二十五年八月十四日（1899年9月18日）迁至北浙江路七浦路口新址的会审公廨。//之前：同治八年三月初九（1869年4月20日）公布生效，总理衙门和公使团核准实施，会审公廨正式成立。 当时，原定《洋泾浜设官会审章程》有效期仅1年，但自颁布后，该章程一直沿用。会审公廨最初位于南京路洋泾浜北首理事衙门原址，光绪八年（1882年）迁到南京路口菜市街对面',
                ],
//                '_tags'=>['孝'],
                '_brothers' => [
                    [
                        'slug' => "slavery-history-in-China",
                        'articleable_id'=>$column_id,'title' => '中囶奴隶史血录',
                        'desc' => '秦：「置奴婢之市，与牛马同栏」；唐：「奴婢贱人，律比畜产」；清：「顺承门内大街骡马市、牛市、羊市又有人市」',
                        'intro' => '张保皋在向新罗王的上书中提到「遍中国以新罗人为奴隶」。黑奴在唐时已出现在关中地区的宫廷、贵族，广州地区分布普遍，那里的豪门贵族不仅自己使用黑奴，还将其贩卖到其它地方，如长江上游四川一带。冯若芳是唐玄宗天宝（742——756）年间的大奴隶主和海盗，他劫取波斯舶，取物为己货，掠人为奴婢。',
                        'author' => '结巢人境（编）',
                        'type' => 'first',
                        'order' => 2,
                        'author_id' => 1,
                        'origin' => '',
                        'origin_date' => '2010/03/01',
                        'show_date' => false,
                        'origin_url' => '',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'deep',
                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                        'comment' => '',
                        '_place' => [
                            'name' => '隋唐长安城遗址保护中心',
                            'addr' => '',
                            'address' => '',
                            'lat' => 34.23297,
                            'lng' => 108.987724,
                            'oldOrPoint' => [
                                'type' => 'point',
                                'name' => '唐长安城',
                            ],
                            'info' => [
                                'intro' => '长安城中，奴隶大约占人口总数的20％至25％。',
                            ]
                        ],
//                '_tags'=>['孝'],
                    ],
                ],
            ],
            [
                'slug' => 'Roman-way-to-not-implicate-family-members',
                'articleable_id'=>$column_id,'title' => '不株连家人的思维方式',
                'desc' => '罗马十二表法「是一切公法和私法的渊源」，这一区分正是后来欧洲走向从自治之路的重要界碑之一。',
                'intro' => '将军 Coriolanus 率领罗马的敌人攻打罗马城，城墙指日可破，罗马人找到他在城中的母亲和妻子',
                'author' => '萧瀚',
                'origin' => '',
                'origin_date' => '2006/10/01',
                'show_date' => false,
                'origin_url' => '//mp.weixin.qq.com/s?__biz=MjM5MDIxNjY2MA==&mid=2650445266&idx=1&sn=feb4c604463fe90499deff173cc8057c',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'member',
                'created_at' => '2017/06/16',
                'comment' => '',
                '_vol' => [
                    'title' => '株连',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => '罗马共和广场',
                    'name_en' => 'Piazza della Repubblica',
                    'addr' => '',
                    'address' => '',
                    'lat' => 42.9243543,
                    'lng' => 10.4099575,
                    'comment' => '',
                    'info' => [
                        'relation' => false,
                    ]
                ],
            ],
        ]);

//            $articles =
        array_merge($articles, [
            [
                'slug' => 'English-speaking-nations-contributions',
                'articleable_id'=>$column_id,'title' => '英语民族的独特贡献',
                'desc' => '英语国家为新大陆带去了他们独特的政治文化观念，这一过程完全不同于法国和西班牙的美洲殖民地。',
                'intro' => '英语国家为新大陆带去了他们独特的政治文化观念，这一过程完全不同于法国和西班牙的美洲殖民地。',
                'author' => 'Daniel Hannan',
                'origin' => '<z-lang title="How We Invented Freedom Why It Matters">自由的基因:我们现代世界的由来</z-lang>',
                'origin_date' => '2013/11/01',
                'show_date' => false,
                'origin_url' => '//mt.sohu.com/20170327/n485100254.shtml',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'member',
                'created_at' => '2017/06/17',
                'comment' => '',
                '_vol' => [
                    'title' => 'English speaking nations',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_place' => [
                    'name' => 'Runnymede',
                    'name_en' => '',
                    'addr' => '',
                    'address' => 'Runnymede is a water-meadow alongside the River Thames in the English county of Surrey, and just over 20 miles (32 km) west of central London.',
                    'lat' => 51.3948093,
                    'lng' => -0.6090198,
                    'info' => [
                        'intro' => '1215 年6 月 15 日，国王签署 The Great Charter。此文件规定王权受法律的限制。1297 年的英文版本至今仍然是英格兰和威尔士的有效法律。',
                    ]
                ],
            ],
//            [
//                'slug' => 'refuse-eat-food-handed-out-in-contempt',
//                'articleable_id'=>$column_id,'title' => '“不食嗟来之食”随想——两种远古尊严观和护卫尊严之道',
//                'intro' => '如果饿者接受了道歉，那就成就了一件君子相交的美谈。',
//                'author' => '结巢人境',
//                'author_id' => 1,
//                'origin' => '',
//                'origin_date' => '2017/07/21',
//                'show_date' => true,
//                'origin_url' => null,
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'member-list',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                'comment' => '',
//                '_vol' => [
//                    'title' => '不食嗟来之食',
//                    'column_id' => $column_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
//                '_place' => [
//                    'name' => '加尔各答',
//                    'name_en' => '',
//                    'addr' => '',
//                    'address' => '',
//                    'lat' => 22.6754807,
//                    'lng' => 88.0520086,
//                    'info' => [
//                        'intro' => '在加尔各答，叶名琛写诗，作画，见客。直到从中囶带来的米粮吃光，绝食而死。',
//                    ]
//                ],
////                '_tags'=>['孝'],
//                '_quotes' => [
//
//                ],
//            ],
            [
                'slug' => 'xiaoshun-westerner',
                'articleable_id'=>$column_id,'title' => '不讲孝顺的西方人 —— 与三个洋人的舌战',
                'intro' => '他们常常拿中囶人取乐。我常常通宵做功课，就为了第 2 天去和这些洋人打嘴仗。有一天我兴奋地想到“孝”，这帮忘恩负义，浑身毛还没有煺干净的洋猴子，根本就没有任何孝的概念。',
                'desc' => '在西方人看来，我们博大精深的孝文化居然完全没有逻辑，也缺乏道德。',
                'author' => '翁维民',
                'origin' => '',
                'origin_date' => '2013/07/23',
                'show_date' => true,
                'origin_url' => 'http://weng-weimin.hxwk.org/2013/07/23/%e4%bb%8e%e5%ad%9d%e5%ad%97%e8%ae%b2%e8%b5%b7/',
                'copyright' => '',
                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                'type' => 'first',
                'created_at' => '2017/06/22',
                'comment' => '',
                '_place' => [
                    'name' => '悉尼',
                    'name_en' => 'Sydney',
                    'addr' => 'Australia',
                    'address' => '',
                    'lat' => -33.8679049,
                    'lng' => 151.1924822,
                    'info' => [
                        'intro' => '80 年代末，「我在悉尼一家洋人的广告公司打工」',
                    ]
                ],
//                '_tags'=>['孝'],
                '_vol' => [
                    'title' => '孝顺',
                    'column_id' => $column_id,
                    'no' => ++$column_no_start,
                    'person_id' => null,
                ],
                '_brothers' => [
                    [
                        'slug' => 'Confucianists-xiao-and-honour-father-and-mother',
                        'articleable_id'=>$column_id,'title' => '儒家孝道与 Christianity honouor 父母的诫命',
                        'desc' => '西方的孝道是怎么样的',
                        'intro' => '我们对人的理解更多带有自然的倾向，强调自然性的身，而非精神性的心。',
                        'type' => 'first',
                        'author' => '石衡潭南',
                        'origin' => '《天涯》2016.4',
                        'origin_date' => '2016/03/17',
                        'show_date' => true,
                        'origin_url' => 'http://www.toutiao.com/i6303315738715226626/',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                        'comment' => '',
                        '_place' => [
                            'name' => '孔庙',
                            'name_en' => '',
                            'addr' => '山东曲阜',
                            'address' => '',
                            'lat' => 35.5968413,
                            'lng' => 116.9885693,
                            'info' => [
                                'intro' => '孔庙现有九进院落，殿、堂、坛、阁460多间，门坊54座，如今规模来自大清皇帝雍正。1724 年,孔庙几乎被大火烧成废墟，这位满洲人下令重建，成为朝廷重点工程，<a href="http://blog.sina.com.cn/s/blog_571b3d930101ev2o.html" title="曲阜12府">孔氏人宅第借机兴建</a>。',
                                'relation' => false,
                            ]
                        ],
                    ],
                    [

                        'slug' => 'xiaoshun-not-simple',
                        'articleable_id'=>$column_id,'title' => '孝顺不是那么简单',
                        'desc' => '孝顺，把每个人从一出生的时候就规范化了。你要做人，首先，最基本的一点是，你要孝顺！',
                        'intro' => '「夫孝，德之本也」，「天之经也，地之义也，民之行也。」用今天的话说，就是如果一个人不孝顺的话，连最基本的做人资格都没有了。',
                        'type' => 'normal',
                        'author' => 'Richard_lea',
                        'origin' => '',
                        'origin_date' => '2008/02/24',
                        'show_date' => true,
                        'origin_url' => 'http://blog.wenxuecity.com/myblog/32212/200802/34092.html',
                        'copyright' => '',
                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
                        'comment' => '',
                    ],

//                    [
//                        'slug' => '外囶的“不肖子孙”——做外囶人的媳妇',
//                        'articleable_id'=>$column_id,'title' => '外囶的“不肖子孙”——做外囶人的媳妇',
//                        'intro' => '不讲孩子孝顺老人，而强调彼此的尊重和平等。父母管教孩子，好像也就是为上帝管教子民，更加强调监护人的责任义务，更注重教育孩子遵守社会道德和规范。',
//                        'author' => '南风和蓝',
//                        'origin' => '',
//                        'origin_date' => '2013/07/23',
//                        'show_date' => true,
//                        'origin_url' => 'http://xyz503.blog.163.com/blog/static/209767151201232992517137/',
//                        'copyright' => '',
//                        'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                        'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                        'comment' => '',
//                        '_place'=>[
//                            'name' => '荷兰',
//                            'name_en' => 'Holland',
//                            'addr' => '',
//                            'address' =>'',
//                            'lat' => 52.1284512,
//                            'lng' =>3.4047967
//                        ],
//                    ],

                ],
            ],
//            [
//                'slug' => '欧麦拉的孩子：杀一人与丧天下',
//                'articleable_id'=>$column_id,'title' => '欧麦拉的孩子：杀一人与丧天下',
//                'intro' => '',
//                'author' => '押沙龙',
//                'origin' => '',
//                'origin_date' => '2014/10/27',
//                'show_date' => false,
//                'origin_url' => 'http://weibo.com/p/1001603770302189465702',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                '_vol' => [
//                    'title' => '选择',
//                    'column_id'=> $column_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
//                'comment' => '',
//            ],
//            [
//                'slug' => 'the-first-Citizenship--lesson',
//                'articleable_id'=>$column_id,'title' => 'Citizenship 第一课',
//                'intro' => '',
//                'author' => '林达',
//                'origin' => '《扫起落叶好过冬》.2006.10',
//                'origin_date' => '2006/10/01',
//                'show_date' => false,
//                'origin_url' => '',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                'comment' => '2005 年新京报版本文字上略有不同，且有两处删减，故取全版。 http://www.people.com.cn/GB/news/37454/37461/3594032.html',
//                '_vol' => [
//                    'title' => 'citizenship',
//                    'column_id'=> $column_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
////                '_note' => [
////                    '_slug' => '',
////                    'slug' => '',
////                    'articleable_id'=>$column_id,'title' => '',
////                    'intro' => '',
////                    'author' => '结巢人境',
////                    'author_id' => 1,
////                    'created_at' => '2016/09/03',
////
////                    'status' => 1, 'deep' => 'open',
////                    'comment' => '',
////                ],
//            ],
//            [
//                'slug' => 'zun yan',
//                'articleable_id'=>$column_id,'title' => '
//                有些人就是要尊严
//铂程斋--台湾，一位与军方死磕访民的故事
//http://www.dapenti.com/blog/more.asp?name=xilei&id=108182
//',
//                'intro' => '',
//                'author' => '',
//                'origin' => '',
//                'origin_date' => null,
//                'show_date' => false,
//                'origin_url' => '',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                'comment' => '',
//                '_vol' => [
//                    'title' => 'zun yan',
//                    'column_id'=> $column_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
////                '_note' => [
////                    '_slug' => '',
////                    'slug' => '',
////                    'articleable_id'=>$column_id,'title' => '',
////                    'intro' => '',
////                    'author' => '结巢人境',
////                    'author_id' => 1,
////                    'created_at' => '2016/09/03',
////
////                    'status' => 1, 'deep' => 'open',
////                    'comment' => '',
////                ],
//            ],
//            [
//                'slug' => '你以为你是谁',
//                'articleable_id'=>$column_id,'title' => '你以为你是谁',
//                'intro' => '',
//                'author' => '林奇',
//                'origin' => '',
//                'origin_date' => '2015/12/26',
//                'show_date' => false,
//                'origin_url' => 'http://weibo.com/p/1001603924250825254159',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                '_vol' => [
//                    'title' => 'who ',
//                    'column_id'=> $column_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
//                'comment' => '',
////                '_note' => [
////                    '_slug' => '',
////                    'slug' => '',
////                    'articleable_id'=>$column_id,'title' => '',
////                    'intro' => '',
////                    'author' => '结巢人境',
////                    'author_id' => 1,
////                    'created_at' => '2016/09/03',
////
////                    'status' => 1, 'deep' => 'open',
////                    'comment' => '',
////                ],
//            ],
//            [
//                'slug' => '科普三原则',
//                'articleable_id'=>$column_id,'title' => '科普三原则
//                甭看说了这么多，其核心思想就一条，那就是对人的尊重。
//
//http://www.dapenti.com/blog/more.asp?name=xilei&id=98834
//',
//                'intro' => '',
//                'author' => '',
//                'origin' => '',
//                'origin_date' => null,
//                'show_date' => false,
//                'origin_url' => '',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                'comment' => '',
//                '_vol' => [
//                    'title' => 'ke pu',
//                    'column_id'=> $column_id,
//                    'no' => ++$column_no_start,
//                    'person_id' => null,
//                ],
////                '_note' => [
////                    '_slug' => '',
////                    'slug' => '',
////                    'articleable_id'=>$column_id,'title' => '',
////                    'intro' => '',
////                    'author' => '结巢人境',
////                    'author_id' => 1,
////                    'created_at' => '2016/09/03',
////
////                    'status' => 1, 'deep' => 'open',
////                    'comment' => '',
////                ],
//            ],
//            [
//                'slug' => 'bu-jiang-xiao-shun-de-xi-fang-ren',
//                'articleable_id'=>$column_id,'title' => '被框住',
//                'intro' => '',
//                'author' => '梁文道',
//                'origin' => '時代週報',
//                'origin_date' => '2010/12/02',
//                'show_date' => false,
//                'origin_url' => 'http://www.hellotw.com/yjpt/pldzh/fxxdl/201012/t20101202_625615.htm',
//                'copyright' => '',
//                'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                'created_at' => date('Y/m/d h:i:s', $create_time + $column_no_start * 10000),
//                'comment' => '',
//                '_vol' => [
//                    'title' => 'kuang zhu',
//                    'column_id'=> $column_id,
//                    'no' => ++$column_no_start,
//                ],
////                '_note' => [
////                    '_slug' => '',
////                    'slug' => '',
////                    'articleable_id'=>$column_id,'title' => '',
////                    'intro' => '',
////                    'author' => '结巢人境',
////                    'author_id' => 1,
////                    'created_at' => '2016/09/03',
////
////                    'status' => 1, 'deep' => 'open',
////                    'comment' => '',
////                ],
//            ],
        ]);
        $this->addArticles($articles);

    }


}