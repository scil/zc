<?php

//use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->freeDir = storage_path() . '/free/quote/';
        $this->sourceDir = __DIR__ . '/quote_src/';

//        File::cleanDirectory($this->freeDir);
        DB::table('quotes')->truncate();

        $book_id = MENU_ITEMS["paper"]['id']; //;
        $zhi_ren_ye_id = MENU_ITEMS["green"]['id'];
        $rain_id = MENU_ITEMS["spirit"]['id']; //
//        $si_id=MENU_ITEMS["zhen/think"]; // 15;

        $ren_id = MENU_ITEMS["human/road"]['id'];
        $ren_home = MENU_ITEMS["human/so"]['id'];
        $ren_indiv = MENU_ITEMS["human/indiv"]['id'];

        $fan_ren = MENU_ITEMS['sail/walkers']['id'];
        $fan_cai = MENU_ITEMS['sail/assets']['id'];
        $fan_dao = MENU_ITEMS['sail/road']['id'];
//        $fan_zhi=MENU_ITEMS['/sail/zhi'];

        $items = [
        ];

        $column_no_start = 0;
        $column_id = $rain_id;
        $items = array_merge($items, [

            [
                '_slug' => 'chang_' . ++$column_no_start,
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                '_place' => [
                    'name' => '纽约视觉艺术学院',
                    'name_en' => 'School of Visual Arts',
                    'lat' => 40.738758,
                    'lng' => -73.9844157,
                    'info' => [
                        'title' => '泣不成声',
                    ]
                ],
                '_image' => [
                    'local' => '/img/2016/Divine-Comedy.jpg',
                    'url' => 'http://www.fotosay.com/userimages/blogimages/2011/0516/lixiaozhun/04122640093b.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '但丁之舟 by Eugène Delacroix',
                ],

                'order' => $column_no_start,
                'title' => '《神曲》',
                'slug' => 'Divine-Comedy',
                'body' => '有一门课是《神曲》，结果来了个老头子，这个老头子教了一辈子《神曲》，将近40年。他会讲<z-la title="维吉尔"> Virgil </z-la>带<z-lang title="但丁"> Dante </z-lang>游地狱，游完以后要到天堂了， Virgil 就消失了。老头子每次讲到这里都会泣不成声，在课堂上大哭起来，这就是我说的善良。他讲了40年，重复了上千遍，可每次讲课还会受不了，眼泪喷出来。',
                'author' => '陈丹青',
                'origin' => '教育与囶运',
                'origin_date' => '2014/12/10',
                'show_date' => false,
                'origin_url' => '//mt.sohu.com/20150724/n417453738.shtml',
                'origin_tip' => null,
                'editor_id' => 1,

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'chang_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                '_place' => [
                    'name' => '云岭剧场',
                    'addr' => '丽江',
                    'address' => '云南丽江古城区',
                    'lat' => 26.8802778,
                    'lng' => 100.2291823,
                    'info' => [
                        'title' => '舞',
                        'relation' => false,
                    ]
                ],
                '_image' => [
                    'url' => 'http://img.chyxx.com/2017/05/20170510093201fj_m.png',
                    'local' => '/img/2016/yangliping.jpg',
                    'alter' => "//photocdn.sohu.com/20151207/mp46747023_1449450060219_2_th_fv23.jpeg",
                    'style' => null,
                    'alt' => '杨丽萍',
                ],

                'order' => $column_no_start,
                'title' => '她眼中的美学',
                'slug' => 'beauty-in-her-eyes',
                'body' => '去采访杨丽萍，她对于生活中所有实际的事情毫无感觉和说话欲，对所有舞蹈的细节挑剔则到了偏执的地步，旁边的工作人员，无法理解她眼中的美学。',
                'author' => '蒋方舟',
                'origin' => '',
                'origin_date' => '2013/10/10',
                'show_date' => false,
                'origin_url' => 'http://yuedu.163.com/news_reader/s#/~/source?id=ee894a890ff54bf6a67bbc2ac7bb10b9_1&cid=bd6466a7a5e64858a15889a15b9d245b_1',
                'origin_tip' => null,
                'editor_id' => 1,

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
//            [
//                '_slug' => 'chang_' . (++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                '_place' => [
//                    'name' => '中国人民大学东门',
//                    'addr' => '北京',
//                    'address' => '',
//                    'lat' => 39.969703,
//                    'lng' => 116.319994,
//                    'info' => [
//                        'relation' => false,
//                    ]
//                ],
//                '_image' => [
//            'local' => '/img/2016/yangliping.jpg',
//                    'url' => '//www.ccln.gov.cn/uploadImage/dangshidagjian/dangshi/dswk/1358147569530.jpg',
//                    'alter' => null,
//                    'style' => null,
//                    'alt' => 'Snow visits China 1970',
//                ],
//
//                'order' => $column_no_start,
//                'title' => '斯诺夫人',
//                'slug' => 'Mrs.Snow',
//                'body' => 'Mrs. Snow 90 年代一次来访。<span lang="ru">Правительство</span>看她生活比较艰难，欲以演讲费等形式给点资助，亦算是对 Snow 过去帮助中囶革命的感谢。 她谢绝了，说：Snow 和我在世界上讲的话，之所以有人相信，全因他们认定我们和 <span lang="ru">КПК</span> 没有利益关系，所言所论皆出自我们的“独立”观察。如果我拿了钱，今后没人再信我们的话了，连以前说的也都不信。[^snow]
//
//[^snow]: Edgar Snow 有两任妻子。
//第一任妻子 [Helen Foster Snow](http://www.nytimes.com/1997/01/14/world/helen-foster-snow-89-a-founder-of-industrial-co-ops-in-china.html) 1997 年去世，[<span lang="ru">КНР</span> 官方举行纪念大会](//blog.sina.com.cn/s/blog_634131a40100n907.html)，相关资料：「从中国来的“客人”经常为她的窘迫生活而难过不安，愿向她提供一些必要的资助，但海伦每次都予以拒绝，她说，这就是她想要的生活」（[斯诺写<西行漫记>过程中从未到过延安](www.huaxia.com/wh/gjzt/2007/00702851.html)）。
//第二任妻子 Lois Wheeler Snow ，与 Edgar Snow 在 1949 年结婚，1970 年两人应邀[在天安门城楼参加国庆典礼](http://blog.sina.com.cn/s/blog_5de8a665010138e3.html) ,1973 年 未名湖畔 Snow 骨灰安葬仪式上，她说「在这里，对人类的尊重达到了新的高度，在这里，世界的希望发射着新的光芒」，此后常收到访中邀请。但在 90 年代已与 <span lang="ru">КНР</span> 官方组织无联系，之后只在 2000 年到中囶一次<z-deep>：[\'Tam Just Woke Me Up\'](//edition.cnn.com/ASIANOW/time/features/interviews/int.snow.html)； [Chinese Film\'s Version of Mao Backfires](http://articles.latimes.com/2002/jan/04/entertainment/et-bodeen4) </z-deep>
//',
//                'author' => '徐斌',
//                'origin' => '',
//                'origin_date' => '2012/02/01',
//                'show_date' => false,
//                'origin_url' => 'http://blog.sciencenet.cn/blog-481697-566908.html',
//                'origin_tip' => null,
//                'editor_id' => 1,
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],


//            [
//                '_slug' => 'book_' . (++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '“蚁族”这词不成立',
//                'slug' => '蚁族这词不成立',
//                'body' => '“蚁族”实际上是一个不成立的词，它带着旁观者居高临下的傲慢，充斥着一元成功学的庸俗价值观。我的朋友王力，一个毕业没多久的大学生，曾如此表达对这个词的不屑：「每次看到蚁族这种词我都由衷感到愤怒，这个词大张旗鼓的宣传了这样一种价值：一个刚毕业没多久的大学生住在一个狭小的租来的房间里，就是可悲的。去他妈的，我09年毕业的时候，住在办公室里，一个月伙食费300块钱，我从来没觉得自己过得可悲」。
//',
//                'author' => '宋石男',
//                'origin' => '',
//                'origin_date' => '2010/07/02',
//                'show_date' => false,
//                'origin_url' => 'http://ssnly100.blog.163.com/blog/static/115633920106274815168/',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright' => '<img src="//mp.weixin.qq.com/mp/qrcode?scene=10000004&size=102&__biz=MzAxNjU2MzA2OQ==">',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
//            [
//                '_slug' => 'book_' . (++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '不愿再说天明宽慰的话',
//                'slug' => '不愿再说天明宽慰的话',
//                'body' => '在新年寄语里曾提到，不祝大家富贵，但祝躲过<z-deep cite="//tieba.baidu.com/p/2615860862">特权与不公</z-deep>。这过于乐观的话放在近日不免让人耻笑。不愿再说天明宽慰的话。长夜才刚开始，黑暗中请记得太阳的模样，沉默中不要为魔鬼歌唱。',
//                'author' => '网易新闻客户端',
//                'origin' => '',
//                'origin_date' => '2013/09/26',
//                'show_date' => false,
//                'origin_url' => '//weibo.com/1974808274/AbbCZaiBp',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright' => '<img src="//mp.weixin.qq.com/mp/qrcode?scene=10000004&size=102&__biz=MzAxNjU2MzA2OQ==">',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],

//            [
//                '_slug' => 'book_' . (++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '不是五毛',
//                'slug' => '不是五毛',
//                'body' => '我在给某届毕业生上最后一课时，曾掏出五毛钱，撕成两半，扔地上，问同学们要吗？没人要。我又掏出一百元，撕成两半扔地下，说你们要吗？ 一大群人举手。我就说，你们都是那一百元，即使被撕烂，即使被猥琐的教育制度所伤害，要记得你们仍是那一百元。一百元就是一百元，不是五毛。
//',
//                'author' => '宋石男',
//                'origin' => '',
//                'origin_date' => '2010/07/02',
//                'show_date' => false,
//                'origin_url' => 'http://ssnly100.blog.163.com/blog/static/115633920106274815168/',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright' => '<z-wechat title="四一哥">songshinan41</z-wechat>',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
        ]);

        /*  book */
        $column_no_start = 0;
        $column_id = $book_id;
        $items = array_merge($items, [
        ]);

        /*  si */
//        $column_no_start =0;
//        $column_id=$si_id;
        $items = array_merge($items, [
        ]);

        /*  ren */
        $column_no_start = 0;
        $column_id = $ren_id;
        $items = array_merge($items, [
            [
                '_slug' => 'ren_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '每一个人毫无例外地都只是一个匆匆过客',
                'slug' => '每一个人毫无例外地都只是一个匆匆过客',
                'body' =>
                    '一个人的生命在宇宙中也许算得上是卑微的，在人类社会的历史长河中也如一粒砂子一样渺小，但是他的独特性与唯一性，足以有资格说出属于自己的声音。人都是要死的，每个人的生命都是宝贵的，他们都有权利直接面对这个世界来说出自己真实的感受。无论什么人都不能够代表我来说出这个独特的感受。无论什么权威的光环都不能够罩住我生命的光芒。每一个人来到这个世界都曾经是赤条条，而且几十年之后都要再次赤条条地消失。人生说到底只是一个匆匆过客。每一个人毫无例外地都只是一个这样的过客。正因为意识到这一点，西方人说上帝面前大家是平等的，而且是人人平等的。既然如此，一个世俗的权威顶着一个世俗的光环就可以压倒另一个独特的生命体吗？我的朋友铁芳先生说，当今世界需要一个众人喧哗的局面。他说得是对的。在茫茫宇宙中，就大小而言，你的生命也许是卑微的，但是你的生命在世俗的社会却是至尊的。无论你的生命多么卑微，无论你的声音多么弱小，都不要放弃自己发出声音的权利。',
                'author' => '许锡良',
                'origin' => '',
                'origin_date' => '2007/10/28',
                'show_date' => false,
                'origin_url' => 'http://blog.ifeng.com/article/3354939.html',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'ren_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '个体一文不值？',
                'slug' => '个体一文不值？',
                'body' =>
                    '你可以认为我作为个体一文不值，我也可以认为我作为个体一文不值，但一个体制认为个体一文不值，这个社会就很可怕了',
                'author' => '冯克利',
                'origin' => '',
                'origin_date' => null,
                'show_date' => false,
                'origin_url' => '',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],

        ]);

        /*  home */
        $column_no_start = 0;
        $column_id = $ren_home;
        $items = array_merge($items, [
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '我应该谢谢你',
                'slug' => 'I-should-thank-you',
                'body' => '大学 4 年~~中~~，我有 3 年半~~的时间~~与留学生住在一起。
                
一次我在足球比赛中受伤，撕裂了大腿肌肉，疼痛难忍，夜不能寐。大约后半夜两点，我的房门被轻轻叩响，一位瘦削斯文的英囶同学出现在门口，手中拿着一个精致的小木盒。他用还不熟练的汉语对我说：「很对不起，这么晚来打搅你。我刚从外面回来，听说你受了伤，我想你现在一定很难受。这里有一盒我从英囶带来的专治肌肉撕裂的药，效果不错，请你试试吧。」

尽管他的发音不准，讲的也并不流利，可在我听来，却是世界上最美妙最动人的表达。我不知如何表达内心的感受，只是机械地重复着「谢谢！谢谢！」不想这位英国「绅士」在感动之上又给了我新的感动，他说：「其实，我应该谢谢你。」

「为什么？」我万分不解。

他似乎有些激动地说：「因为，你是第一个不问价钱接受我帮助的中囶人。」

说完，便带着十足英囶式的自豪与满足转身走了，留给我一个全新的「致谢观」和对人生、金钱、社会的深深思考。',
                'author' => '朱铁志',
                'origin' => '《杂文选刊》2007 年 02 期（上）.本土“留学”散记',
                'origin_date' => '2007/02/01',
                'show_date' => false,
                'origin_url' => 'http://blog.sina.com.cn/s/blog_62c5cbd50100jp9m.html',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                '_place' => [
                    'name' => '北京大学',
                    'name_en' => 'Peking University',
                    'lat' => 39.9869171,
                    'lng' =>116.3036799,
                    'info' => [
                        'title' => '1979 - 1982 作者就读大学哲学系',
                        'intro' => '',
                        'relation' => false,
                    ]
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '中囶梦里最牛的人',
                '_tags' => [
                    [
                        'name' => '硫酸雨',
                        'official' => $column_id,
                    ],
                ],
                'slug' => 'American-style-values',
                'body' =>
                    '美囶梦对等级是没有很强的、发自内心的尊重。但是中囶人的梦呢，**对既定的等级有一种敬畏**。~~我们~~++中囶人++吹牛说**看到哪个官怎么摆谱，谈得非常津津有味，都是仰视。梦里想的是「取而代之」，而对怎么奋斗、创新，其实~~大家~~++中囶人++是不太关心的**。比如说在美囶，小孩子跟家长聊天，说我崇拜一个人，那要说是因为这个人做了什么东西。但中囶家庭，在同样的话题下，我的感觉是**很少有人会注意到“贡献”这个问题**。~~大家~~++中囶人++更多讲那个人买了什么车，买了什么房子，家长也是这样。在中囶梦里最牛的人是什么人呢？是不付出努力而能够得到很多的人，这是最高目标。',
                'author' => '项飙',
                'origin' => '',
                'origin_date' => '2017/05/07',
                'show_date' => false,
                'origin_url' => 'https://zhuanlan.zhihu.com/p/26800369',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_image' => [
                    'local' => '/img/2016/第一任协和董事会.jpg',
                    'url' => 'https://tc.sinaimg.cn/maxwidth.800/tc.service.weibo.com/mmbiz_qpic_cn/376fc2177d9307535353102606418d22.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '第一任协和董事会',
                    'title' => '',
                    'intro' => '<b>Peking Union Medical College 第一任董事会 右起第三人为小洛克菲勒</b>。<br>1912 年夏天，老洛克菲勒在老家的树荫下，举办了一场中囶问题分享会，450 位宾客挤满庭院，洛克菲勒夫人为这些滔滔不绝的客人们准备了冰水。小洛克菲勒领导了次年成立的洛克菲勒基金会，使命是「为了全人类的幸福和健康」。基金会在中囶创办了北京协和医学院，三十多年总计投入 4800 万美元。1951 年医院主人更换，新协和「专门设立外宾和高干门诊部，开设专门的高干、外宾、特需病区」。',
                ],
                '_place' => [
                    'name' => '',
                    'name_en' => 'Pocantico Hills, New York',
                    'lat' => 41.0945388,
                    'lng' => -73.8534774,
                    'info' => [
                        'place_name' => '2017 年，洛克菲勒辞世（1915-2017）',
                        'title' => '零用钱',
                        'intro' => '1929 年，小洛克菲勒和 14 岁儿子约翰·D·洛克菲勒制定了零用钱处理细则，其中规定：双方同意至少20%的零用钱将用于公益事业',
                        'relation' => false,
                    ]
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
                // todo
                // 美君01：基于物质并没错，毕竟不可能人人都是苦行僧…华族竞争特点是几乎全部精力都在物质上，对思想、灵魂、道德…兴趣都不大，对消费主义文化有些要求；所以，甚至在逆境中，也能快速发展生产力；问题点也在于此：除了物质就很少有超越物质之上的东西了。 http://weibo.com/5527193038/FkFqS4nft?type=comment
                // 美君01：回复@Moses003:物质建设使生活提高到60分，物质之上的意识建设使生活达到90分…华族往往认为60分远大于30分，因此特别重视物质，所以社会得分总是在65-70，很难再高。
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '在巴黎的温州人不再倚重关系',
                'slug' => 'Wenzhou-Paris-guanxi',
                'body' =>
                    '在不同的制度中，身处不同地方（如温州本地、北京、巴黎等）的温州人有着许多相似的或相同的行为方式，比如他们在做事的过程中都偏好于动用社会关系；又比如，他们都热衷于在一起做事（集群特征）；等等。

但是，不同的制度情境确实会影响人们的一些行为。调查中发现，如果制度越不完善，那么社会关系的作用就越大，反之亦然。

比如，在20世纪90年代北京的浙江村，那里的温州人在寻求制度解决无果的情况下都会转向以内群体的方式去行动，强化了社会关系在他们中的作用。离开了这样的社会情境，在巴黎，温州人为了适应法囶的制度和社会风俗、传统，确实会对他们的行为进行一定的修正和调整。他们知道法囶有着完善的法律体系以及严格的执法程序，他们就得遵循，也会去遵守，否则会受到难以承受的制裁代价，所以他们在守法上会更为自觉一些，当然也可以说是在被强制和威胁下的一种自觉，然后慢慢地变成真正的自觉。

与此同时，他们相应地会减少对人际关系的倚重。',
                'author' => '王春光',
                'origin' => '',
                'origin_date' => '2018/02/02',
                'show_date' => false,
                'origin_url' => 'https://mp.weixin.qq.com/s/9RFZ-LMHfTs_yN5ePFL_TQ',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_image' => [
                    'local' => '/img/2016/巴黎的温州人.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '《巴黎的温州人》',
                ],
                '_place' => [
                    'name' => '巴黎美丽城',
                    'name_en' => 'Belleville',
                    'lat' =>48.8711372,
                    'lng' => 2.3779443,
                    'info' => [
                        'title' => '美丽城遍布温州人店铺',
                        'intro' => '超市、花店、理发店、金饰店、蛋糕店、豆腐店、网吧。“巴黎士多”、“新温州”、“今日”、“新中华”，华人超市共有20多家。',
                        'relation' => false,
                    ]
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
                // todo
                // 美君01：基于物质并没错，毕竟不可能人人都是苦行僧…华族竞争特点是几乎全部精力都在物质上，对思想、灵魂、道德…兴趣都不大，对消费主义文化有些要求；所以，甚至在逆境中，也能快速发展生产力；问题点也在于此：除了物质就很少有超越物质之上的东西了。 http://weibo.com/5527193038/FkFqS4nft?type=comment
                // 美君01：回复@Moses003:物质建设使生活提高到60分，物质之上的意识建设使生活达到90分…华族往往认为60分远大于30分，因此特别重视物质，所以社会得分总是在65-70，很难再高。
            ],
        ]);

//        $items =
        array_merge($items, [

            [
                '_slug' => 'si_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '忍受？',
                'slug' => '忍受？',
                'body' => '<z-lang title="It is easy enough to say that man is immortal simply because he will endure: that when the last dingdong of doom has clanged and faded from the last worthless rock hanging tideless in the last red and dying evening, that even then there will still be one more sound: that of his puny inexhaustible voice, still talking.">有一种再容易不过的说法：人反正会一代代存活下去，因为他会忍耐；最后的末日钟声响起，最后一次的黄昏垂死残红，最后的一块无用岩石已没有潮水拍身，钟声从岩石上消逝，万声不在，这时人类微弱的声音仍在不断言说。</z-lang>
<z-lang title="I refuse to accept this. ">这样的说法我是绝对不能接受的。</z-lang><z-lang title="I believe that man will not merely endure: he will prevail. ">我相信人不仅仅会存活，他还会越活越好。</z-lang><z-lang title="He is immortal, not because he alone among creatures has an inexhaustible voice, but because he has a soul, a spirit capable of compassion and sacrifice and endurance. ">他是不朽的，并不是因为生物中只有他嗓音不倦，而是因为他有灵魂，有能够同情、牺牲和忍耐的精神。</z-lang>…… <z-lang title=" the courage and honor and hope and pride and compassion and pity and sacrifice which have been the glory of his past">勇敢、荣誉、希望、尊严和同情，这些是人类历史上的荣光</z-lang>。',
                'author' => '福克纳（William Faulkner）',
                'origin' => '《福克纳演说词》.诺贝尔文学奖致辞',
                'origin_date' => '1950/12/10',
                'show_date' => false,
                'origin_url' => 'http://www.24en.com/subject/speech/2012-07-25/147355.html',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'si_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '命运交给别人',
                'slug' => '命运交给别人',
                'body' => '相信好人也罢，相信长官也罢，二者其实是一样。总之，把自己的命运交给别人，甚至交给某一个两个人，自己一点也不动脑筋，只是相信别人，那太危险了。好人做好事，不错；好人做错事，怎么办？',
                'author' => '巴金',
                'origin' => '《随想录》',
                'origin_date' => null,
                'show_date' => false,
                'origin_url' => '',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'xianxiajiaoyi' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '',
                'slug' => '',
                'body' => '你在旅行途中遇到过哪些感人的人或事？
',
                'body_long' => '_',
                'author' => '',
                'origin' => '',
                'origin_date' => '2015/08/26',
                'show_date' => true,
                'origin_url' => '//weibo.com/6219328168/F7mBGChYr',
                '_place' => [
                    'name' => '',
                    'addr' => '',
                    'lat' => 30.6693408,
                    'lng' => 104.0878017,
                    'info' => [
                        'place_name' => '府河（锦江）',
                        'intro' => '',
                    ]
                ],
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'xianxiajiaoyi' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '我拒绝线下交易',
                'slug' => 'refuse-offline-deals ',
                'body' => '闺密也把空房子做了 Airbnb 民宿，今天说遇到一个奇葩，要同她线下交易（为了省站方的税费），她拒绝了，那人就骂了她。我也是坚决拒绝线下交易。很多客人会觉得，线下交易，双方都避免了给站方的税费、管理费，双方得利的事情，为什么不同意？

我不这样看。第一，我不想免费使用平台，以前从收手续费的易趣，转到“免费”的淘宝，已经让我看到破坏规则的竞争，最终受伤害的就是商家的利益。淘宝靠免费挤走了规范收费的易趣，最终淘宝的各项收费，远远高过易趣NNN倍。而且淘宝还有黑幕，易趣很透明简单，就是按交易收取服务费而已。但是，易趣已被我们自己放弃了，再也回不去了。
',
                'body_long' => '_',
                'author' => '',
                'origin' => '',
                'origin_date' => '2015/08/26',
                'show_date' => true,
                'origin_url' => '//weibo.com/6219328168/F7mBGChYr',
                '_place' => [
                    'name' => '府南河活水公园',
                    'addr' => '成都',
                    'lat' => 30.6693408,
                    'lng' => 104.0878017,
                    'info' => [
                        'place_name' => '府河（锦江）',
                        'intro' => '',
                    ]
                ],
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '他的最高利益',
                'slug' => '他的最高利益',
                'body' => '1994 年，曾有一位美囶医生明知道病人是 <z-la title="耶和华见证人" lang="en">Jehovah\'s Witnesses</z-la>（他们不接受献血和输血），仍然坚持认为病人的最高利益是性命，而为病人输血。结果，当事人以不尊重自身的宗教立场而向医生提出控诉，而最高法院的判断竟然是，该病人的最高利益是其<z-false>~~信仰~~++生存权++</z-false>，故裁定该医生<z-false>~~侵犯了病人的自决权~~++没有过错++</z-false>。

在面对一个让人似乎无法接受，不符合世俗伦理的“宗教怪癖”时，社会和医学界非但没有将之斥之为异端或“邪教”，而是致力于为信仰与生命的矛盾打开一条出路。

 Jehovah\'s Witnesses 与世俗社会最格格不入的还有一点：反对任何战争，拒绝任何信徒入伍服兵役，拒绝任何军事训练。而在很多国家，强制兵役都是宪法规定的公民义务，违者需要入狱服刑。面对信仰与法律义务发生的矛盾，很多国家和地区都选择了给信仰让路。比如说台湾，2000 年后出台了替代役制度，因宗教等特殊因素而无法服兵役的人可转服替代役。',
                'author' => '张明扬',
                'origin' => '拒绝效忠希特勒的“邪教”',
                'origin_date' => '2014/06/08',
                'show_date' => false,
                'origin_url' => 'http://dajia.qq.com/blog/414110074995748.html',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'open',
                'comment' => '',

                // todo
                // 生与死的权利

            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '每一次我受到善待',
                'slug' => '每一次我受到善待',
                'body' => '<z-lang title="Every kindness I received, small or big, convinced me that there could never be enough of it in our world. To be kind is to respond with sensitivity and human warmth to the hopes and needs of others. Even the briefest touch of kindness can lighten a heavy heart. Kindness can change the lives of people.">每一次我受到善待，无论小善或是大善，都使我相信：世上有再多的善也不会嫌多。为善，是用敏感的心去体察他人的需要，用温暖的情去回应他人的期望。若有善在，一个最简单的动作也能打破一颗沉寂的心灵。善，可以改变人们的生命。</z-lang>
',
                'author' => 'Aung San Suu Kyi',
                'origin' => 'Nobel Peace Prize Acceptance Speech',
                'origin_date' => '2012/06/16',
                'show_date' => false,
                'origin_url' => 'http://www.independent.co.uk/news/world/asia/aung-san-suu-kyi-a-lesson-in-the-value-of-kindness-7856643.html',
                'origin_tip' => null,

                '_image' => [
                    'local' => '/img/2016/aung-san-suu-kyi-house.jpg',
                    'url' => 'http://ccm.ddcdn.com/ext/photo-s/07/71/b1/88/aung-san-suu-kyi-house.jpg',
                    'alter' => null,
                    'style' => 'object-fit: cover;max-height: 240px;',
                    'alt' => 'Aung San Suu Kyi\'s house',
                ],
                '_place' => [
                    'name' => null,
                    'name_en' => 'Aung San Suu Kyi\'s house',
                    'addr' => '仰光',
                    'lat' => 16.824987,
                    'lng' => 96.14261,
                    'info' => [
                        'intro' => 'Aung San Suu Kyi was placed under house arrest for a total of 15 years over a 21-year period',
                        'relation' => false,
                    ]
                ],
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
//            [
//                '_slug' => 'child_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '多好的一场交响乐',
//                'slug'=>'多好的一场交响乐',
//                'body' =>
//                    '有一个女孩儿她说夜间她哭喊，打雷她害怕、哭，她爸爸来了以后没有把她抱起来，而坐在旁边说孩子你听，这就像交响乐，那个是鼓，多好的一场交响乐。所以以后到了雷雨交加就是这幅画面。所以观念的东西往往是我讲，他是人在成长过程当中，在父母陪伴过程当中随事随景，就情景的景，给你的一幅画面。',
//                'author' => '李玫瑾',
//                'origin' => '',
//                'origin_date' => '2014/01/04',
//                'show_date' => false,
//                'origin_url' => '//phtv.ifeng.com/program/qqsrx/detail_2014_01/04/32724768_1.shtml',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '几十名记者、体育局官员围着一对年迈的父母',
                'slug' => '几十名记者、体育局官员围着一对年迈的父母',
                'body' => '有这样一幕，深深镌刻在记者的脑海里。一间<z-false>++美囶++</z-false>县宾馆会议室，几十名记者、体育局官员围着山村里接来的一对年迈的奥运选手父母。当奥运选手夺奖牌无望后，刹那间只留下年迈的父母，以及一骑绝尘的悲凉，甚至，都没有人送老人回家。',
                'author' => '张志龙',
                'origin' => '新华网',
                'origin_date' => '2012/07/30',
                'show_date' => false,
                'origin_url' => '//epaper.lsnews.com.cn/lsrb/html/2012-07/31/content_436809.htm',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'member',
                'comment' => '',
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '需要贡献才能刻上去吗？',
                'slug' => '需要贡献才能刻上去吗？',
                'body' =>
                    '唐山地震 30 周年，有一对老夫妇，在他们失去的双胞胎儿子的骨灰盒上，放上了一块巧克力。这情景被香港记者报道出去后，令许多香港读者落泪。当时，柴静曾问过这对老夫妇：将来如果有纪念墙，你们会不会把孩子的名字刻上去？他们说，孩子又没对囶家做什么贡献。她又问，需要贡献才能刻上去吗？',
                'author' => '黄艾禾',
                'origin' => '《记忆：刻下每个死难者的名字》.《国家历史》2008年6月上',
                'origin_date' => '2008/06/01',
                'show_date' => false,
                'origin_url' => 'http://gjls0799.blog.163.com/blog/static/39511691200851251918166/',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                '_place' => [
                    'name' => null,
                    'name_en' => '唐山大地震罹难者纪念墙',
                    'lat' => 39.595588,
                    'lng' => 118.189329,
                    'comment' => '原为唐山矿的采煤沉陷区，公园于2008年9月建成http://www.gooood.hk/tangshan-earthquake-park.htm .
                    地震罹难者纪念墙等基础工程于2008年7月28日前完工',
                    'info' => [
                        'intro' => '唐山大地震罹难者纪念 2008 年 7 月建成',
                    ]
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '给这个工厂的客户发函',
                'slug' => '给这个工厂的客户发函',
                'body' =>
                    '我也算做过一些环保公益诉讼的，法院要不是不敢立案，就是<span lang="ru">Правительство</span>会立即封杀这些报道，曾经在某地有一对夫妇，家门口有一个垃圾场和粉碎塑料机器等，他的第一个孩子白血病死了，第二个孩子生出来又有罕见疾病，村里癌症病人不少，曝光之前，投诉无效，曝光之后，<span lang="ru">Правительство</span>把垃圾车所在的泥都挖走了。工厂也暂时消失了，后来在诉讼中，<span lang="ru">Правительство</span>、工厂，无一承担责任，就是因为因果关系难以证明。虽然在环保诉讼中是举证倒置，但最终<span lang="ru">Правительство</span>、工厂，都以村里得癌症几率和另一个地方相差无几来反证。

另一个空气环境污染案例，居民多次投诉无~~故~~++效++，最终是靠环保组织给这个工厂的客户美囶 Timberland Co. 发函，说你的客户不环保，你居然号称绿色企业，这个 Timberland 再给这个工厂施加压力来缓解。这和很多中囶富士康公司劳工权利要和美囶 Apple Inc. 谈一样，多么嘲讽。',
                'author' => '斯伟江',
                'origin' => '《雾霾、观念、制度、人》',
                'origin_date' => '2015/03/01',
                'show_date' => true,
                'origin_url' => 'http://weibo.com/p/1001603815831569090544',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                'status' => 1, 'deep' => 'deep',
                'comment' => '',
            ],
//            [
//                '_slug' => 'home_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '她不停地被拉去接受采访',
//                'slug' => '她不停地被拉去接受采访',
//                'body' => '她难忘++美囶++<!-- {.z-false} -->地震发生后在北川中学采访的经历。一位女教师为了照顾学生而来不及寻找自己的女儿。第二天天亮的时候，当她跑去寻找女儿时，却发现孩子埋在废墟下，早已没了气息。作为记者，王婕忠实地记录下这个故事。但她一直为这位老师担心。每逢有同事到北川采访，她都会委托对方了解一下这位老师的现状。传来的消息大多是：她不停地被拉去接受采访，参加各种电视节目……最终，在今年春节的时候，王婕听说这位老师疯了。 ',
//                'author' => '',
//                'origin' => '',
//                'origin_date' => null,
//                'show_date' => false,
//                'origin_url' => 'http://zqb.cyol.com/content/2009-05/13/content_2664176.htm',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
//            [
//                '_slug' => 'home_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '15 岁和 13 岁',
//                'slug' => '15岁和13岁',
//                'body' => '刘胡兰的同母亲妹妹刘爱兰。11 岁时目睹其姐惨死于铡刀之下当场吓晕在地，深受刺激。1948 年，刘爱兰参军后被分配到战斗剧社。领导强行要求她在剧中扮演刘胡兰。演至“英勇就义”一折，刘爱兰面对铡刀当场吓疯。终生饱受精神分裂症的折磨。刘胡兰死时不足 15 岁，刘爱兰疯时刚满 13 岁。',
//                'author' => '',
//                'origin' => '',
//                'origin_date' => null,
//                'show_date' => false,
//                'origin_url' => '',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
//            [
//                '_slug' => 'home_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '那几个，就会一把傻力气',
//                'slug' => '那几个，就会一把傻力气',
//                'body' => '当初在中文大学，见到几个<abbr title="香港中文大学">中大</abbr>学生围着~~刘翔~~++游泳名将 Michael Phelps (菲尔普斯)++<!-- {.z-false} -->。不知怎么说到旁边几个举重还是神马项目的++美囶++<!-- {.z-false} -->冠军，~~刘翔~~++Phelps++<!-- {.z-false} -->说：那几个~~农村的~~++黑人++<!-- {.z-false} -->，就会一把傻力气……当时几个香港学生一愣，随即转身离开。<z-deep>大陆也是这样。一开始香港人跟你挺有亲切感。一号看到你丫的真面目，就不鸟你了</z-deep>',
//                'author' => '@fading_you1',
//                'origin' => '',
//                'origin_date' => '2016/08/29',
//                'show_date' => false,
//                'origin_url' => 'https://twitter.com/fading_you1/status/770229648667967488',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
        ]);


        /* indiv */
        $column_no_start = 0;
        $column_id = $ren_indiv;
        $items = array_merge($items, [

            [
                '_slug' => 'child_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '我不会要求你以我为正确',
                'slug' => 'not-ask-you-consider-me-an-authority',
                'body' =>
                    '爱人觉得有必要确立自己在儿子面前的权威，但儿子并不听他的，他能吓住孩子，使孩子就范，但并没有在孩子那里得到他想要的威信。一天他对我说，孩子现在听你的，你应该要求他……，我问儿子：你最听妈妈的话，是这样的吗？儿子点了点头。

我说：可是妈妈并不要求你听我的啊，我不会要求你以我为正确，这个世界上，没有任何一个人可以要求你听从他。你会有自己的判断，并能用你的智慧平衡自己与他人，自己与社会的关系。 ',
                'author' => '奎塔',
                'origin' => '孩子为何不宽容不感恩？——评论分享',
                'origin_date' => '2015/11/04',
                'show_date' => false,
                'origin_url' => '//weibo.com/p/23041854377c2a0102wov5',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                '_image' => [
//                    'url' => 'http://s2.sinaimg.cn/middle/6e13c0fegba7982584671&690',
                    'local' => '/img/2016/《弟子规》父母教-须敬听-父母责-须顺承.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '《弟子规》：父母教,须敬听;父母责,须顺承',
                    'intro' => '《弟子规》成书于满清时期，在同一时代的《爱弥儿》中，作者卢梭说「包括他的父亲在内，没有人有权利支使孩子去做对他毫无用处的事情。」',
                ],
                '_place' => [
                    'name' => '克拉玛依友谊馆',
                    'lat' => 45.600785,
                    'lng' => 84.865811,
                    'info' => [
                        'title' => '「我呢 就没有管」',
                        'deep' => 'member',
                        'intro' => '[徐辛紀錄片截图](http://wx2.sinaimg.cn/bmiddle/643c6f05ly1fe647zd1g4j20go2chn5e.jpg)中女教师說：當時「一下子全场就站起来」，「穿着皮衣的这个同志就说『坐下，讓領導先走』。我呢就没有管，我说，走，走人，我们的学生马上就站起来了」。这位教师的学生们得救了，她儿子葬身在火海。',
                        'relation' => false,
                    ]
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => 'Forever a fighter, never a victim',
                'slug' => 'Forever-a-fighter-never-a-victim',
                'body' =>
                    '看到一女孩肩后纹身写着：「宁做战士，不做受害人。」（ Forever a fighter, never a victim ).   
Don\'t be a victim 已成美囶人共识。它的意思不是要人去和人争和人斗，而是在任何关系里面，不老是把自己放在「受害人」的角色之下。它相信人每一步皆有个体选择的自由，而不是等着他人来改变、解救自己。',
                'author' => '方柏林',
                'origin' => '',
                'origin_date' => '2015/09/08',
                'show_date' => false,
                'origin_url' => '//weibo.com/1894493187/CzD5VkcTt',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_image' => [
                    'url' => null,
                    'local' => '/img/2016/chinese-checkers.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '',
                    'intro' => null,
                ],
                '_place' => [
                    'name' => '鸦片战争博物馆',
                    'name_en' => 'The Opium War Museum',
                    'addr' => '广东东莞',
                    'address' => '广东省东莞市虎门镇口村',
                    'lat' => 22.8251929,
                    'lng' => 113.657381,
                    'oldOrPoint' => [
                        'type' => 'point',
                        'name' => '林则徐销烟池',
                    ],
                    'info' => [
                        'title' => '缴烟容易画押难 两方对弈各显神通',
                        'intro' => '林则徐禁烟，不怕得罪参与鸦片贸易的权臣和水师，招待“英夷”更是有理有力：围困旅馆断水断粮、画押连坐制（甘结）。而反对鸦片贸易的义律，践守他的司法标准和人权标准，遇事也不唉声叹气。被赶到海上没淡水？接雨水喝！英船私自入关贸易？开炮逼回！林则徐在浙江的好友也不是口炮党：扫荡英人墓地把尸首扔到海里喂鱼，对英俘实施游街和凌迟处死。棋盘越摆越大，参与方没人谈屈辱，没人做怨妇，都在费心使力，在对弈中加强了解。',
                        'relation' => false,
                    ]
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '不接受命运的青年，偷偷出逃',
                'sub_title' => '后来成为地下自由组织的领导者',
                'slug' => 'Tubman-liberty-or-death',
                'body' =>
                    '马里兰是她的国，在这个国她只能被奴役。难道活着只能如此吗？ 自由北国的存在告诉 Tubman ,人生还有其它选择，但需要她以生命做注。1849 年，眼看要被女主人卖出偿债，Tubman 拒绝丈夫的劝阻，只身逃亡。路上得到废奴主义者和贵格会教徒的帮助，成功逃到北方。Tubman 说："[T]here was one of two things I had a right to, liberty or death; if I could not have one, I would have the other." 此后，她加入北方的救助奴隶组织，多次潜回南方，带领奴隶投奔自由的北方。',
                'author' => '方柏林',
                'origin' => '',
                'origin_date' => '2015/09/08',
                'show_date' => false,
                'origin_url' => '//weibo.com/1894493187/CzD5VkcTt',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_image' => [
                    'url' => 'https://image.syracuse.com/home/syr-media/width328/img/news/photo/2017/02/18/originaltubman-0218jpg-ba206cd20d656f99.jpg',
                    'local' => '/img/2016/Harriet-Tubman.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => 'Harriet Tubman',
                    'intro' => null,
                ],
                '_place' => [
                    'name' => '哈丽特·塔布曼童年的家',
                    'name_en' => 'Harriet Tubman Childhood Home',
                    'addr' => 'Dorchester County, Maryland',
                    'lat' => 38.4089125,
                    'lng' => -76.3014093,
                    'info' => [
                        'title' => '虽然有吃有喝有穿',
                        'intro' => '但她要另外一种生活，一种命运不被人摆布的生活，宁愿以生命为代价。',
                        'relation' => true,
                    ]
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '孩子是自己的花朵',
                'slug' => 'children-whoes-flower',
                'body' =>
                    '有人在儿童节向孩子献词，称：「加油孩子！今天是祖国的花朵 明天做民族的脊梁」。

本来应该是，孩子是自己生命的花蕊期，最多是家长的花朵（子代），与国家有啥关系？孩子的未来属于自己，为啥是民族的脊梁？我不是抬杠，是说出常识。

@醉里挑灯看剑blog：强调人身依附关系呗。  

> 你的孩子不属于你  
> 他们是生命的渴望 是生命自己的儿女  
> 经由你来到世上 与你相伴  
> 却有自己独立的轨迹  
>
> <cite>卡里·纪伯伦 . [《孩子》](/human/road/On-Children) </cite>
',
                'author' => '@史前人类A',
                'origin' => '',
                'origin_date' => '2018/06/04',
                'show_date' => false,
                'origin_url' => 'https://weibo.com/1132243740/Gjkm4hEbQ',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_image' => [
                    'url' => 'http://www.scarymommy.com/wp-content/uploads/2017/03/shutterstock_450844810.jpg?w=700',
                    'local' => '/img/2016/children-are-not-your-children.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '',
                    'intro' => null,
                ],
                '_place' => [
                    'name_en' => 'Bsharri',
                    'addr' => 'Lebanon',
                    'address' => '',
                    'lat' => 34.2506498,
                    'lng' => 35.9942225,
                    'oldOrPoint' => [
                        'type' => 'point',
                        'name' => 'Gibran（纪伯伦）的家乡',
                    ],
                    'info' => [
                        'title' => '成长在奥斯曼帝国的山区中（今黎巴嫩）',
                        'intro' => '12 岁和母亲、哥哥、妹妹到美囶波士顿唐人街谋生，离开了家乡，离开了黑暗的奥斯曼帝国（9 岁时，父亲被人诬陷入狱，家里的房子和财产被没收，三年后，尽管父亲被无罪释放，但坚强的母亲还是决定远走美囶。）',
                        'relation' => false,
                    ]
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'home_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '我没能力说',
                'slug' => 'I-have-no-ability-to-talk',
                'body' =>
                    '有娃一直想让说说叙利亚问题<z-editor>（编：美英法刚刚轰炸叙利亚的化武据点）</z-editor>，实话实说，这问题真是没能力说。。这个问题是中东问题的一部分，中东问题我是不大敢开口的，原因很简单，了解的太少，中文无论现实资讯还是各种著述，坦率说，在这方面太贫乏太贫乏了，咱还且不说几十年来中文对中东问题的报道，基本上都没有任何真正资讯意义。也就是说，我们所沉浸的中文世界，对中东问题基本上是睁眼瞎，而且还是戴着铁锈红哈哈墨镜的睁眼瞎。我是在这个世界里建立的对中东那点**天然扭曲的可怜认知，而且缺乏自我修正的基本条件与能力，我能说啥？敢说啥？**',
                'author' => '@老枪plus ',
                'origin' => '',
                'origin_date' => '2018/04/15',
                'show_date' => true,
                'origin_url' => 'https://weibo.com/6051802122/Gcbo1rpIT',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_image' => [
                    'local' => '/img/org/book.jpg',
                ],
//                '_place' => [
//                    'name_en' => '白宫',
//                    'addr' => 'The White House',
//                    'address' => '',
//                    'lat' =>38.8975412,
//                    'lng' => -77.0397592,
//                    'info' => [
//                        'title' => '罗斯福为参战日军划出化武红线',
//                        'intro' => '1942.6.5 白宫正式警告日本：若在中囶战场继续使用这种不人道的武器，美国将视作对己身之攻击，并以同类手段报复（such action will be regarded by this Government as though taken against the United States, and retaliation in kind and in full measure will be meted out）。日军被迫停用化武。（[《固应惩化武，亦须觅人和》](https://weibo.com/2001464705/GcvfOe2GV)） ',
//                        'relation' => false,
//                    ]
//                ],
                '_place' => [
                    'name' => '苏格拉底监狱',
                    'name_en' => 'Socrates Prison',
                    'addr' => 'Socrates Prison',
                    'address' => 'Athens, Greek',
                    'lat' =>37.9693245,
                    'lng' => 23.7110882 ,
                    'oldOrPoint' => [
                        'type' => 'point',
                        'name' => '苏格拉底',
                        'name_en' => 'Socrates ',
                    ],
                    'info' => [
                        'place_name'=>'雅典',
                        'title' => '苏格拉底：我知道我不知道',
                        'intro' => '《新唐书·魏征传》提供了一种评估信息环境的方法：「兼听则明，偏听则暗。」 如果接触的信息只有一种倾向、一种观点，那会让自己变傻。成熟的皇权制度，会让臣属互相牵制、分别汇报、鼓励告密鼓励攻讦，以实现皇帝自己「明」。',
                        'relation' => false,
                    ]
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
        ]);


        /*  fan ren */
        $column_no_start = 0;
        $column_id = $fan_ren;
        $items = array_merge($items, [
            [
                '_slug' => 'fan_ren_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '先人们的足迹',
                'sub_title' => '闯荡亚欧非的 M168',
                'slug' => 'M168',
                'year' => -120000,
                'sig' => 2,
                'desc' => '东亚人的祖先不是北京人，也不是元谋人。他们和走出非洲的一批批远古人一样，都灭绝了。存活至今的，只有我们这只幸运人种。',
                'body' => '如果问华人的祖先是谁？有人会说，北京人。但是，北京人在晚期智人还没有走出非洲时就已经灭绝了。几百万年以来，一批一批的非洲人走出故乡，但全都灭绝了，除了现代人类这只奇葩。人类分子学证明，现代人类无论黄白黑人种，其实是完完全全的一个物种，有着共同的祖先。男性染色体 XY，Y 随男性代代相传。通过分析全球人类染色体的突变节点和节点的产生时间，可以看出整个人类的大致演变过程。十万多年以前，Y 染色体突变产生 M168 ，携带者是绝大多数欧亚人的祖先，所以也叫作“欧亚亚当”。相对于元谋人、北京直立人来说，今天的所有东亚人是后来的殖民者，没有什么「自古以来」。',
                'body_long' => '_',
                'author' => '安森垚、超级无敌摩托车',
                'origin' => '知乎 2016《人类都起源自非洲吗？》',
                'origin_date' => '2016/10/01',
                'show_date' => false,
                'origin_url' => 'https://www.zhihu.com/question/33526473',
                'origin_tip' => null,
                'created_at' => '2017/04/01',
                'editor_id' => 1,
                'copyright' => '',

                '_place' => [
                    'name' => '现代人起源于 East Africa',
                    'name_en' => '',
                    'lat' => 4.963217,
                    'lng' => 36.422387,
                    'info' => [
                        'fromto' => 'from',
                    ]
                ],
                '_image' => [
//                    'url' => 'http://ngm.nationalgeographic.com/ngm/0603/feature2/images/mp_full.2.jpg',
                    'local' => '/img/2016/Human Migration.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => 'Human Migration',
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],

            [
                '_slug' => 'fan_ren_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => 'Joseph Pierce',
                'sub_title' => '咸丰二年 十岁的他移民到美洲',
                'slug' => 'Joseph-Pierce',
                'year' => 1852,
                'sig' => -1,
                'body' => 'Joseph Pierce，1842 年生于中囶广东。10 岁时，咸丰二年、太平天国二年，他被一位船长带到美囶抚养(或是其家人把他卖给了船长)。

南北战争爆发后，20 岁的 Pierce 入伍。1863 年 7 月参与葛底斯堡遭遇战后，他志愿参加了第二天的新一场战斗，因此役战功任职士官，是为数不多且事迹可查的早期美囶华裔军人之一。随后，他被派往 New Haven 从事招兵工作，1864 年 9 月归队（此时他去母囶 12 年，太平天国都城刚刚陷落）。

Pierce 退伍后定居 Meriden, Connecticut，与 Martha Morgan 女士结婚，生二女二子，73 岁辞世，葬于胡桃木墓园（Walnut Grove Cemetery）。当地报纸上刊登了他的讣告，介绍他是「知名、受人喜爱」（well know and liked）。此时，母囶正经历袁世凯错误称帝，地缘强国——大日本帝国——趁机出手制造动乱（[《日本反对，是袁世凯失败的关键》](http://cul.qq.com/a/20171106/042812.htm)）。

移民新大陆，是旧大陆人口、经济等危机的释放和缓解，更为人类个体和人类整体的发展提供了更多可能。',
                'author' => '',
                'origin' => 'wikipedia',
                'origin_date' => null,
                'show_date' => false,
                'origin_url' => 'https://zh.wikipedia.org/zh-cn/%E7%BA%A6%E7%91%9F%E5%A4%AB%C2%B7%E7%9A%AE%E5%B0%94%E6%96%AF',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/12',
                'copyright' => '',
                '_image' => [
                    'local' => '/img/2016/Corporal-Joseph-Pierce.jpg',
                    'url' => null,
                    'alter' => null,
                    'style' => "max-width:450px",
                    'alt' => '约瑟夫·皮尔斯下士戎装照',
                ],

                '_place' => [
                    'name' => '梅里登',
                    'name_en' => 'Meriden, Connecticut',
                    'lat' => 41.5371748,
                    'lng' => -72.8719198,
                    'info' => [
                        'fromto' => 'to',
                        'title' => '安葬于家乡胡桃木墓园',
                        'intro' => '退伍后，23 岁的 Pierce 定居在这里，73 岁辞世。',
                    ]
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_ren_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '占领火星',
                'slug' => 'occupy-mars',
                'year' => 2018,
                'sig' => 4,
                'desc' => 'SpaceX 总部所在地加州 Hawthorne，经常能看到穿着“占领火星”T恤的人招摇过市，那些就是 SpaceX 员工。',
                'body' => '2008 年，SpaceX 险些死掉。其首枚火箭「猎鹰1号」连续发射失败 3 次；「前三次都搞砸了……第四次若失败肯定就完蛋了……」其时 SpaceX 员工只剩下 50 多人；就在此时，他的电动汽车公司 Tesla 也陷入困境，「我也离婚了。那是我人生中最糟糕的一年。」2017 年当 SpaceX 成功后，Elon Musk 这样回忆道。

约 10 年之后，SpaceX 已完成了 50 次发射。2018.03.06,「猎鹰9号」发射了「重达6吨，体积几乎相当于一辆城市公交车」的通讯卫星。在公众眼中，Elon Musk 成为现实世界中的「钢铁侠」；但公众看不到的，是 SpaceX 脚踏实地、16 年如一日的艰辛努力。

SpaceX 总部的餐厅，就在火箭装配车间上方，通过巨大的玻璃墙，工程师一面匆匆午餐，一面继续监督火箭的维修与组装；SpaceX 的研发项目组不需繁琐行政手续，而是把构想直接与 Elon Musk 沟通，取得首肯后就立马去干（Elon Musk 迟迟不把 SpaceX 上市，就是不愿被董事会掣肘）……此类"垂直管理“模式风险极大，大公司尽量避免，只有创业公司才会阶段性采用。

Elon Musk 性格暴躁，对拖慢研发进度者毫不留情、当面斥责……SpaceX 以大浪淘沙的严酷方式，以惊人的淘汰率最终遴选了一批与 Musk 性格相近的“疯子”。在其总部所在地加州 Hawthorne，经常能看到穿着「占领火星」T恤的人招摇过市，那些就是 SpaceX 员工。
                ',
                'author' => '美君01',
                'origin' => '《巴别之塔》',
                'origin_date' => '2018/3/16',
                'show_date' => true,
                'origin_url' => 'https://weibo.com/ttarticle/p/show?id=2309404218330813707429&mod=zwenzhang',
                'origin_tip' => null,
                'created_at' => '2018/5/23',
                'editor_id' => 1,
                'copyright' => '',

                '_place' => [
                    'name' => 'SpaceX',
                    'name_en' => 'SpaceX',
                    'lat' => 33.919662,
                    'lng' => -118.3286913,
                    'info' => [
                        'title' => '“疯子”',
                        'fromto' => 'from',
                    ]
                ],
                '_image' => [
                    'local' => '/img/2016/occupy-mars.png',
                    'alter' => null,
                    'style' => null,
                    'alt' => 'SpaceX T-shirts occupy mars',
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
//            [
//                '_slug' => 'fan_ren_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $fan_ren,
//
//                'order' => $column_no_start,
//                'title' => 'Joseph Pierce',
//                'slug'=>'Joseph-Pierce',
//                'body' =>'1937 年《大公报》：中日全面战争开始后，上万美国人自愿来华参加抗战，因经费难以筹集，一部分将自费来华。
//![美青年将校士兵多人　愿自动来华参加抗战](http://ww4.sinaimg.cn/bmiddle/605ee5a8jw1dguyfa88p5j.jpg)<!-- {alter=""} -->
//                ',
//                'author' => '',
//                'origin' => 'wikipedia',
//                'origin_date' => null,
//                'show_date' => false,
//                'origin_url' => '',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                '_place'=>[
//                    'name' => '梅里登',
//                    'name_en'=>' Meriden, Connecticut',
//                    'lat' =>41.5371748,
//                    'lng' =>-72.8719198,
//                ],
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
//            [
//                'slug' => 'Zhu-Zhiyu',
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'body' => '朱之瑜，生于 1600 年（明万历二十八）。长兄任南京神武营总兵，随长兄寄籍松江府，研究古学，尤擅长《诗》、《书》。
//
//明亡后为光复华夏奔波日本、安南等地求援。1660 年，郑成功、张煌言领导的北伐军收复瓜州，攻克镇江，朱之瑜亲历行阵。北伐军兵威震动东南，落败在南京城外。郑成功最后趋兵台湾，张煌言数年后被捕遇害。朱之瑜鉴于复明无望，又誓死不剃发，「乃次蹈海全节之志」，学鲁仲连不帝秦，再次渡日，永不回到故囶了。这年冬，最后一次东渡日本，未能获准登岸，困守舟中。当时日本施行锁国政策、「三四十年不留一唐人」。日本学者安东守约，以手书向朱之瑜问学，执弟子礼。朱之瑜为安东守约「执礼过谦」的恭敬、「见解超卓」的学问所动，复信安东守约。信中，朱氏悲喜交集，悲则囶破家亡，故囶「学术之不明、师道之废坏亦已久矣」；喜则「岂孔颜之独在中华，而尧舜之不绝于异域」，表达了他有意将圣贤践履之学传于这位异囶弟子的心情。正如梁启超所说，此「为先生讲学之发轫」。 安东守约等人为其在日定居奔走。最后得日本政府批准，破 40 年来日本幕府之国禁，让他在长崎租屋定居下来，朱之瑜就此结束了十多年的海上漂泊生活。
//
//日本副将军德川光国礼聘朱氏讲学，并欲为建新居，朱以「耻逆虏之末灭，痛祭祀之有阙，若丰屋而安居，非我志」力辞。
//
//朱舜水 83 岁辞世，留下遗言：「予不得再履汉土，一睹恢复事业。予死矣，奔赴海外数十年，未求得一师与满虏战，亦无颜报明社稷。自今以往，区区对皇汉之心，绝于瞑目。见予葬地者，呼曰『故明人朱之瑜墓』，则幸甚。」东京大学农学院内至今立有「朱舜水先生终焉之地」（临终之地）的石碑。
//
//明崇祯时，朱之瑜曾以「文武全才第一」荐于礼部，但见「世道日坏、国是日非」、「官为钱得，政以贿成」，遂放弃仕途，专注于学问。他不求功名利禄，而热衷於关心社会民生，常对人讲：「世俗之人以加官进禄为悦，贤人君子以得行其言为悦。言行，道自行也。盖世俗之情，智周一身及其子孙。官高则身荣，禄厚则为子孙数世之利，其愿如是止矣。大人君子包天下以为量。在天下则忧天下，在一邦则忧一邦，惟恐民生之不遂。至於一身之荣瘁，禄食之厚薄，则漠不关心，故惟以得行其道为悦。」 ',
//                'author' => '',
//                'origin' => '浙江余姚四先贤 之 朱之瑜',
//                'origin_date' => '2011-07-14',
//                'show_date' => true,
//                'origin_url' => 'http://mren.bytravel.cn/history/2/zhuzhi658189.html',
//                'origin_tip' => null,
//                'editor_id' => 1,
//
//                'created_at' => '2017/05/12',
//                'copyright' => '',
//                '_image' => [
//                    'local' => '/img/2016/Corporal_Joseph_Pierce.jpg',
//                    'url' => null,
//                    'alter' => null,
//                    'style' => "width:240px",
//                    'alt' => '约瑟夫·皮尔斯下士戎装照',
//                ],
//
//                '_place' => [
//                    'name' => '梅里登',
//                    'name_en' => 'Meriden, Connecticut',
//                    'lat' => 41.5371748,
//                    'lng' => -72.8719198,
//                ],
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
        ]);


        /*  fan cai */
        $column_no_start = 0;
        $column_id = $fan_cai;
        $items = array_merge($items, [
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '上古汉语为什么听起来像俄语',
                'slug' => 'Chinese-Yenisei',
                'year' => -50000,
                'sig' => 0,
                'desc' => '上古汉语朗读「所谓伊人，在水一方」，很想俄语，为什么？',
                'body' => '上古汉语起源于叶尼塞河流域(Енисе́й)。叶尼塞河发于贝加尔湖，流入北冰洋。西伯利亚在末冰期之后比现在暖和很多，跟河南差不多。叶尼塞流域是西西伯利亚平原和中西伯利亚高原的结合部，算是亚欧的分界地带，二战时德日计划到此汇合。在蛮荒年代，一些叶尼塞河居民的后裔进入中原，带来了汉语，而原住民逐渐接受了拓殖者的语言，和原有发音融合，形成了不同的方言（类似南美洲广泛使用西班牙语）。

「所谓伊人，在水一方」，[上古汉语朗读《诗经·蒹葭》](//weibo.com/5339555851/FehPSsDmL)别有一番韵味。听起来像俄语，因它与高加索语系有关联，同属「德内-高加索语系」（[Dené–Caucasian languages](https://en.wikipedia.org/wiki/Den%C3%A9%E2%80%93Caucasian_languages)）。

「汉藏-高加索超级语系」的提出者谢尔盖-斯塔罗斯金(Sergei A. Starostin)是俄囶语言学家，也是汉学家，他在上世纪八十年代与美囶汉学家白一平(William Baxter)、中囶学者郑张尚芳不约而同地提出相似的汉语上古音构拟方案，在汉语音韵学研究史上是千载难逢的佳话。^[[从得内（汉）—高加索大语系与Y-Q1a系关联看全球文明同源及欧亚美超级大语门](http://blog.sina.com.cn/s/blog_6a4e1c6f01019sju.html)]
',
                'author' => '史前人类A',
                'origin' => '',
                'origin_date' => '2018/01/09',
                'show_date' => false,
                'origin_url' => 'https://weibo.com/1132243740/FDvZDkzuC',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/03',
                'copyright' => '',
                '_places' => [
                    [
                        'name' => '伊加尔卡',
                        'name_en' => 'Igarka',
                        'lat' => 67.0149035,
                        'lng' => 81.415096,
                        'info' => [
                            'place_name' => 'Ига́рка（俄语）',
                            'title' => '尼塞河下游',
                            'intro' => '尼塞河是世界第五长河，下游连接北冰洋，上游远在 5000 千米外的贝加尔湖。',
                            'fromto' => 'from',
                        ]
                    ],
                    [
                        'name' => '克孜勒',
                        'name_en' => 'Kyzyl',
                        'lat' => 51.6813237,
                        'lng' => 93.8812952,
                        'info' => [
                            'place_name' => 'Кызы́л（俄语、图瓦语）',
                            'title' => '尼塞河上游城市 克孜勒',
                            'intro' => '清后半期时属唐努乌梁海地区，今为图瓦共和国首府。',
                            'fromto' => 'from',
                        ]
                    ]
                ],
                '_image' => [
                    // todo https://upload.wikimedia.org/wikipedia/commons/thumb/c/cc/Yenisei_basin_7.png/450px-Yenisei_basin_7.png
                    'url' => 'https://wx4.sinaimg.cn/mw690/437cab1cly1fn9z7g5d1pj20ha0be40z.jpg',
                    'local' => '/img/2016/叶尼塞河流域.png',
                    'alter' => null,
                    'style' => null,
                    'alt' => null,
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '秦囶客栈与「文化入侵」',
                'slug' => 'Qin-inn',
                'year' => -300,
                'sig' => 0,
//                'limit_height'=>true,
                'desc' => '-「来碗西红柿鸡蛋面。」<br>-「抱歉，客官，面条要到宋朝才能成形呢。西红柿现在南美洲才有，明朝末年才传入中土。到清末才终于有人当菜吃，老舍看不惯称为『文化入侵』。小店目前只有鸡蛋，要不您点一个？」',
                'body' => '-「来碗西红柿鸡蛋面。」<br>-「抱歉，客官，面条要到宋朝才能成形呢。西红柿现在南美洲才有，明朝末年才传入中土。到清末才终于有人当菜吃，老舍看不惯称为『文化入侵』。小店目前只有鸡蛋，要不您点一个？」',
                'body_long' => '_',
                'author' => '无名氏',
                'origin' => '',
                'origin_date' => '2016/10/31',
                'show_date' => false,
                'origin_url' => 'http://www.xcar.com.cn/bbs/viewthread.php?tid=28013727',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/04',
                'copyright' => '本文最初版本名为《某人穿越到先秦》，可能来自《唐朝穿越指南》',

                '_place' => [
                    'name' => '秦咸阳城',
                    'lat' => 34.413278,
                    'lng' => 108.8586899,
                ],
                '_image' => [
                    'url' => 'http://creativebeacon.com/wp-content/uploads/2014/01/fruit_and_vegetables.jpg',
                    'local' => '/img/2016/fruit_and_vegetables.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => null,
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
                // todo 明代以前，中国人不可能吃到的粮食和蔬菜~ http://weibo.com/ttarticle/p/show?id=2309404148015173634153
            ],
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '造纸技术：沿着地缘 缓慢传播 1500 年',
                'slug' => 'papermaking-spread',
                'year' => 1788,
                'sig' => -1,
                'desc' => '造纸技术用了 1500 年传遍亚欧大陆，而新技术不到百年就反哺到了东亚。美国独立那一年，纸张在旧大陆两头有两大不同应用：乾隆下令编纂《逆臣传》，法囶纸商用热气球实现了人类上天零的突破，他们后来还飞到了国王头上。',
                'body' => '古中囶的书写材料不如莎草纸、羊皮纸、贝叶那样方便易得，所以肯定会迎来突破。前所未有的造纸技术发明后，大约用了 1500 年通过战争等方式传遍亚欧大陆，而欧洲技术革命贡献的现代造纸技术，不到 100 年就从欧洲来到了东亚。

乾隆时期是传统造纸技术衰落前的最后阶段：1764 年，法囶经济学家 Turgot 遇到留学的北京人高类思和杨德望，拜托他们回囶后搜集经济资料，还有几个造纸之类的制造工艺问题；1783 年造纸商人孟格菲兄弟实现了人类上天零的突破，他们的热气球使用的一种材料就是纸，而这一年，在皇帝的命令下，很多清国纸张用来编纂《逆臣传》。',
                'body_long' => '_',
                'author' => 'scil（编）',
                'origin' => '',
                'origin_date' => '2015/08/26',
                'show_date' => false,
                'origin_url' => null,
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/03',
                'copyright' => '',
                '_place' => [
                    'name' => '本杰明·富兰克林国家纪念馆',
                    'name_en' => 'Benjamin Franklin National Memorial',
                    'lat' => 39.9582195,
                    'lng' => -75.1751463,
                    'info' => [
                        'place_name' => '富兰克林国家纪念堂（费城）',
                        'title' => '论文',
                        'intro' => '1788 年，比爱新觉罗·弘历大五岁、时任宾夕法尼亚总统的 78 岁老人富兰克林发表论文，比较中欧制作单面平滑大纸张的方法，这时距离人类进入现代造纸时代已不到十年。',
                        'fromto' => 'to',
                    ]
                ],
                '_image' => [
                    'url' => 'http://pic.baike.soso.com/ugc/baikepic2/10443/cut-20150216121024-754037731.jpg/0',
                    'local' => '/img/2016/zhu.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => null,
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '天下医学是一家',
                'sub_title' => '西医、印医、中医都是一回事',
                'slug' => 'origin-of-human-medicine',
                'year' => -50000,
                'sig' => 0,
                'desc' => '苏美尔医学演化出众多分支：欧洲西医、南亚印医、中亚波医、东亚中医……',
                'body' => '人类的医学和人类文明一样，源头是两河流域。而两河连接东西两端，于是西边诞生了希腊医学，东边诞生了印度医学。

生理学上，东西两边都有“气”、“血”这样的玄虚理论，印医有类似中医“脉”、“穴”之类的概念。西医的重要人物希波克拉底讲究“燥、湿、寒、热”的平衡，主张微调病人整体的生理平衡，充分信任身体的自愈机能，思维方式与中医相通。

药物方面，西医、印医，都使用天然的草药、动物、矿物，而且药物药方一直在不同地区有着传播交流，如《黄帝内经》提到药物「自西方来」，波斯医学的长期东传哺育了后世的《本草纲目》。治疗疟疾的灵药金鸡纳，由进取的欧洲人从美洲带到欧洲，又带到亚洲，治好了康熙，生动展示了药物传播的大图景。',
                'body_long' => '_',
                'author' => 'scil（编）',
                'origin' => '',
                'origin_date' => '2017/08/27',
                'show_date' => false,
                'origin_url' => '',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/03',
                'copyright' => '',
//                '_place' => [
//                    'name' => '科斯岛',
//                    'name_en' => 'Kos',
//                    'addr'=>'Greece',
//                    'lat' =>36.8912598,
//                    'lng' =>27.2595204,
//                    'info' => [
//                        'intro' => '希波克拉底是西医的重要代表',
//                    ],
//                ],
                '_place' => [
                    'name' => '阿法克',
                    'name_en' => 'Nuffar',
                    'addr' => 'Al-Qādisiyyah Governorate, Iraq',
                    'lat' => 32.0612026,
                    'lng' => 45.2098982,
                    'oldOrPoint' => [
                        'type' => 'point',
                        'name' => '尼普尔（苏美尔城邦）',
                        'name_en' => 'Nippur',
                        'comment' => 'Nippur was located in modern Nuffar in Afak, Al-Qādisiyyah Governorate, Iraq',
                    ],
                    'info' => [
                        'fromto' => 'from',
                        'title' => '这里出土了人类最早的医书',

//                        'place_name'=>'富兰克林国家纪念堂（费城）',
//                        'intro' => '',
                    ],
                ],
                '_image' => [
                    'url' => 'http://www.ancientpages.com/wp-content/uploads/2017/11/medicinemesopotam19.jpg',
                    'local' => '/img/2016/Medical clay tablet from Nippur.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => null,
                    'intro' => '左侧是一份苏美尔医学泥板，出土于古城邦 Nippur（尼普尔）',
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
                // todo
                // 今天听了1件3观炸裂的事，我1个好 http://weibo.com/5874683697/FjXHPzhNn?from=page_1005055874683697_profile&wvr=6&mod=weibotime
                // 我觉得很有意思，说到替代疗法    http://weibo.com/5874683697/Fk3Vpu0r7?ref=home&rid=14_0_8_2669680907410231991&type=comment
            ],
//            [
//                '_slug' => 'fan_cai_' . (++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '告别西医——人类医学从旧医到新医',
//                'slug' => 'modernization-of-human-medicine',
//                'desc' => '新医（现代医学）打败西医，造福人类。',
//                'body' => '
//
//没有人类的现代医学，甚至也没有人类的前现代医学，老鼠照样活到现在，但人类总是想办法，让同胞活得更好。',
//                'body_long' => '_',
//                'author' => 'scil（编）',
//                'origin' => '',
//                'origin_date' => '2017/08/28',
//                'show_date' => false,
//                'origin_url' => '',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'created_at' => '2017/05/03',
//                'copyright' => '',
////                '_place' => [
////                    'name' => '科斯岛',
////                    'name_en' => 'Kos',
////                    'addr'=>'Greece',
////                    'lat' =>36.8912598,
////                    'lng' =>27.2595204,
////                    'info' => [
////                        'intro' => '希波克拉底是西医的重要代表',
////                    ],
////                ],
//                ],
//                '_image' => [
//                    'url' => 'http://pic.baike.soso.com/ugc/baikepic2/10443/cut-20150216121024-754037731.jpg/0',
//                    'local' => '/img/2016/zhu.jpg',
//                    'alter' => null,
//                    'style' => null,
//                    'alt' => null,
//                ],
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//                // todo
//                // 今天听了1件3观炸裂的事，我1个好 http://weibo.com/5874683697/FjXHPzhNn?from=page_1005055874683697_profile&wvr=6&mod=weibotime
//                // 我觉得很有意思，说到替代疗法    http://weibo.com/5874683697/Fk3Vpu0r7?ref=home&rid=14_0_8_2669680907410231991&type=comment
//            ],
        ]);
//            $items =
        array_merge($items, [
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '武汉中学生钱包丢在美囶 40天后突然回到家',
                'slug' => 'Wuhan-wallet-lost-back',
                'body' =>
                    '一天下午，武汉的卓先生收到一个写满英文的快递包裹，打开一看：里面竟是儿子 40 天前，随学校参加美囶夏令营丢失的钱包，50 美元、10 元人民币、一张学校饭卡、一张居民身份证……邮寄者是美囶迪士尼乐园。卓先生说，钱包丢在那么远的美囶，钱物也很少，但迪斯尼乐园还是将钱包寄还过来，这让他和儿子十分感动。「压根就没想到儿子的钱包会失而复得，我还想着给他补办居民证，没想到美国迪斯尼乐园给他寄还回来。」 包裹上写的都是英文，邮寄人是“Disneyland Park in USA”。',
                'author' => '',
                'origin' => '',
                'origin_date' => '2012/08/30',
                'show_date' => true,
                'origin_url' => 'http://news.sina.com.cn/o/2012-08-30/170525069107.shtml',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/04',
                'copyright' => '',

                '_place' => [
                    'name' => '迪斯尼乐园',
                    'name_en' => 'Disneyland Park',
                    'lat' => 33.8120918,
                    'lng' => -117.9189742,
                    'info' => [
                        'fromto' => 'from',
//                        'place_name'=>'富兰克林国家纪念堂（费城）',
//                        'intro' => '',
                    ],
                ],
                '_image' => [
                    'url' => 'http://www.southcn.com/travel/lyxw/200505080603_1007192.jpg',
                    'local' => '/img/2016/Disneyland-Park.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '迪士尼乐园',
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '美囶加密术走向世界',
                'slug' => 'encryption-spreads-from-America',
                'body' =>
                    '<ins>加密术是信息时代的一大基石，是欧美对人类文明的重大贡献之一。</ins>曾经，这种技术被美国 government 禁止出口，其他囶家的人，想要使用这些加密算法，就像要从美国买导弹一样，是不可能的。转机发生在 1995 年，这一年，<z-lang title="加州伯克利大学" lang="en"> University of California, Berkeley </z-lang>研究生 Bernstein 在组织 Electronic Frontier Foundation（电子前线基金会）帮助下，起诉 government。他的主张是发表加密算法，属于 freedom of speech 的一部分，从而受<z-lang title="第一修正案" lang="en"> First Amendment </z-lang>保护。这个案子史称 Bernstein v. United States，进行了 4 年。到 1999 年，<z-lang title="联邦第九巡回上诉法院" lang="en">Ninth Circuit Court of Appeals </z-lang>做出判决，依据<z-lang title="第一修正案" lang="en"> First Amendment</z-lang>，判决 government 禁止公开密码算法违宪。在这之后，各种密码协议和开源算法从美囶流传出来，供世人自由使用。

EFF 创建于 1990 年，<ins cite="https://www.eff.org/about">是一个在数字世界保护 civil liberties 的非盈利组织。他们通过 impact litigation, policy analysis, grassroots activism, 和技术发展，捍卫用户隐私、自由表达以及创新</ins>。EFF 创始人之一是 Lotus 公司创始人卡普尔，曾经是和比尔盖茨齐名的软件天才。1990 年，当时商业互联网尚未成型，而前瞻的卡普尔意识到未来技术、隐私、法律和政治的冲突，出资创建了 EFF。',
                'author' => '霍炬',
                'origin' => '开源中国社区',
                'origin_date' => '2015/08/26',
                'show_date' => false,
                'origin_url' => 'http://www.oschina.net/news/59475/opensource-and-openssl',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_place' => [
                    'name' => '电子前线基金会（华盛顿特区）',
                    'name_en' => 'Electronic Frontier Foundation(Washington, DC)',
                    'url' => '//www.eff.org',
                    'lat' => 38.9069913,
                    'lng' => -77.0451461,
                    'info' => [
                        'fromto' => 'open',
//                        'place_name'=>'富兰克林国家纪念堂（费城）',
//                        'intro' => '',
                    ],
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '',
                'slug' => '',
                'body' => '《乙酉笔记》记了一段松江海鲜记',
                'body_long' => '_',
                'author' => '',
                'author_id' => 1,
                'origin' => '',
                'origin_date' => null,
                'show_date' => false,
                'origin_url' => '',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                '_place' => [
                    'name' => '圆明园谐奇趣',
                    'lat' => 40.012259,
                    'lng' => 116.307801,
                    'info' => [
                        'intro' => '清据北京一百年后，皇帝乾隆开始营建欧洲建筑。',
                    ]
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '「就采用欧夷的样式吧」——结缘欧洲艺术的圆明园',
                'slug' => 'Yuanmingyuan-European-art',
                'body' => '1860 年火劫之后，石材料的“西洋楼”幸存。这片欧式园林起因于乾隆浏览路易十四赠送的《法囶最漂亮的建筑景观》，设计者是清国宫廷中的传教士 Giuseppe Castiglione（郎世宁）、Michel Benoist（蒋友仁）、Jean-Denis Attiret（王致诚）等人，采用巴洛克和法国凡尔赛宫风格。',
                'body_long' => '_',
                'author' => 'scil（编）',
                'author_id' => 1,
                'origin' => '',
                'origin_date' => '2015/08/26',
                'show_date' => false,
                'origin_url' => null,
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',

                '_place' => [
                    'name' => '圆明园谐奇趣',
                    'lat' => 40.012259,
                    'lng' => 116.307801,
                    'info' => [
                        'intro' => '清据北京一百年后，皇帝乾隆开始营建欧洲建筑。',
                        'fromto' => 'to',
                    ]
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '川菜',
                'slug' => '',
                'body' =>
                    '',
                'author' => '',
                'origin' => '',
                'origin_date' => null,
                'show_date' => false,
                'origin_url' => '',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_place' => [
                    'name' => '',
                    'name_en' => '',
                    'url' => '',
                    'lat' => 38.9069913,
                    'lng' => -77.0451461,
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
//            [
//                '_slug' => 'fan_cai_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '美囶的商业和科学与布尔什维克的智慧相结合',
//                'slug'=>'美囶的商业和科学与布尔什维克的智慧相结合',
//                'body' =>
//                    '1929 年，需求不足把几乎整个资本主义世界逼上了绝路，整个资本主义世界的企业都迫切需要订单。无论订单内容是什么、来自何方，在大萧条的年代它都意味着预期利润和救命的现金流。在理论上说，苏联是整个资本主义世界的敌人，但在英美互为假想敌，德法继续互相仇恨的 30 年代，针对苏联这个贫弱共产主义国家的任何禁运协议都难得落实。所以苏联几乎可以用低廉的价格买它想买的一切东西，无论是工业设备、技术支援还是成套的技术班子。
//1929～1930 年，苏联购买了70％ 的英囶外销设备，到1932年购买了 90％；世界最大的第聂伯河水电站完全是在美囶工程师指导下修建的，巴拿马运河的建设顾问到苏联为中亚干旱地带设计运河。斯大林格勒拖拉机厂的全套设备在美囶制造安装后，整体拆运到苏联，德囶为另一个哈尔科夫拖拉机厂提供技术支持，还与苏联合作研制坦克，日后成为两国劲敌的红色装甲洪流即从此而起。
//当苏联因为缺乏资金而不能提供更多订单的时候，那些未在大萧条中破产的大银行主动提供贷款和信用证。在现金紧缺的年头，因为苏联可以用<span lang="ru">Правительство</span>信用和稳定的增长做担保，西方银行宁愿投资苏联工业，也不为本囶企业提供流动资金。虽然 30 年代的经济发展机会并不是苏联独有——苦于大萧条的西方资本急于谋取利润并规避风险，并不介意合作者是谁。但在当时，只有苏联同时占有三个有利条件——足以保卫自己的军事力量、统一而有活力的政权和不以短期利润为目标的经济模式，从而最充分地利用了这一百年不遇的发展机遇，让人民的血汗得以转化成未来超级大国的基础。
//
//1933 年苏联的官方媒体宣称：「美囶的商业和科学与布尔什维克的智慧相结合，在三四年内已经产生了巨大的效果」。',
//                'author' => '任冲昊',
//                'origin' => 'historical-materialism-and-communism',
//                'origin_date' => '2015/09/09',
//                'show_date' => false,
//                'origin_url' => 'https://github.com/maqianzu/historical-materialism-and-communism/blob/master/chapter26.md',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
//            [
//                '_slug' => 'fan_cai_' . (++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '1909 年，我在上海见到有轨电车初次营运',
//                'slug' => '1909年，我在上海见到有轨电车初次营运',
//                'body' =>
//                    '我是在油灯下看言情小说的，我眼见着标准石油公司的产品进入我的故乡，煤汽灯进入上海的店铺。……我乘坐过轿子、独轮车和人力摇橹的小船。1904 年，我在上海公共租界的街上，见到晚上艳妆歌女都是坐着抬轿匆忙赴台的。以后，在最现代的都市上海，马车成为时尚了。1909 年，我在上海见到有轨电车初次营运。……我和我的国民们一起，走过了从油灯到电灯、从手推车到福特汽车的路程，虽然还谈不上飞机。这一切，是在不到四十年的时间里走完的！',
//                'author' => '胡适',
//                'origin' => '',
//                'origin_date' => '2015/01/01',
//                'show_date' => false,
//                'origin_url' => '',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright' => '',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
        ]);

        /*  fan dao */
        $column_no_start = 0;
        $column_id = $fan_dao;
        $items = array_merge($items, [
            [
                '_slug' => 'fan_dao_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '越来越好？难敌权力返祖',
                'sub_title' => '伊朗女性的地位 起于权力 又落于权力',
                '_tags' => [
                    [
                        'name' => '昙花一现',
                        'official' => true,
                    ]
                ],
                //todo
                // 'data'=>'昙花一现:15y;',
                'year' => 1963,
                'sig' => -1,
                'slug' => 'Iranian-power-and-Iranian-women',
                'desc' => '伊朗，两次转折，女性摘掉黑纱，又被迫戴起，不戴就是反革命。',
                'body' => '1963年，伊朗国王巴列维发动伊朗的改革开放，人称“白色革命”。他改变法律，规定女孩子 18 岁结婚（以前是9岁就嫁人），还赋予妇女选举权，取消神学教育和伊斯兰教法，提倡妇女去掉黑色面纱，废除男性头巾，突出伊朗历史上雅利安人的作用以淡化伊斯兰教影响。在此背景下，女性的地位有了前所未有的进步。

巴列维的经济改革带来伊朗经济飞速发展，1968 年 - 1978 年，平均年增长速度 16─17%。但是，巴列维拒绝权力改革，「自我评价的办法比西方国家必须依靠“忠诚反对派”的办法更加可靠、更加公正」，「为了实现真正的帝国民主，就需要有一个君主从上边进行统一」（[《“白”与“黑”——伊朗的两种“革命”》](http://www.360doc.com/content/15/0808/00/17132703_490226807.shtml)）。半条腿的改革造成腐败猖獗，连补贴到老少边穷的慈善救助金都有人贪腐。

对专制、腐败和穷人境况的不满导致 1978 年爆发革命。参与者中有受过高等教育的女性，参与与宗教无关，只是为了呼吁政治改革。一些中产阶级女性甚至把自己从头到脚裹起来，以表达与下层女性的团结，共同对抗国王。^[[伊朗迷你裙消亡史](https://weibo.com/ttarticle/p/show?id=2309404242460443334949)]

当时所有的西方知识分子都说，这是在赶走暴君。美国政府错误地放弃巴列维，劝说他逃亡。霍梅尼搭乘法航专机回到德黑兰掌握了权力。

1979年3月7日，霍梅尼违背承诺[^伊朗女性反对]，要求妇女必须戴面纱。次日三八妇女节，德黑兰市区的妇女上街反对这项决定，「政府在报纸上公布女性上班必须佩戴头巾。于是，没人去上班」，「当时的伊朗人民充满了热情和希望，人们还相信能够改变些什么」[^伊朗女性反对]，结果被军队驱散。这年7月起，所有妇女都必须在公开场合带上面纱，否则即被视作反革命行为。电影、戏剧、舞蹈、绘画、雕刻中的女性形象被剔除，不得不出现的女性形象也必须按照伊斯兰教规定加以处置。

Feminists 被装在麻袋里面乱石砸死（[《宗教立法后的伊朗的女性》](http://cul.qq.com/a/20150912/017525.htm)）。

十年时间，伊朗女性总失业率由 1976 的 6.9% 上升到 1986 年的 25.2%，这期间女性就业总数减少了 86.12 万人。（[《伊朗伊斯兰革命以来女性失业问题简析》](https://wenku.baidu.com/view/09375dc2581b6bd97e19eaac.html)）

人的地位，起于权力，落于权力，一切由权力生杀予夺，或开恩赏赐，或予取予夺。

「授人以鱼不如授人以渔」，鱼肉重要，但鱼肉的控制权更重要。

[^伊朗女性反对]: [《1979年3月8日，伊朗女性反对佩戴头巾》](https://zhuanlan.zhihu.com/p/25711318)
',
                'author' => '把历史说给你听',
                'origin' => '',
                'origin_date' => '2017-04-06',
                'show_date' => true,
                'origin_url' => 'http://www.sohu.com/a/132286180_620985',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/08/05',
                'copyright' => '',

                '_image' => [
                    'url' => 'https://wx1.sinaimg.cn/large/9b7dd4a1gy1frjwu14ds3j20qp0y5woa.jpg',
                    'local' => '/img/2016/1960年代德黑兰大学医学院课堂上，男生和女生在一个教室听讲.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '',
                    'intro'=>'1960年代，德黑兰大学医学院课堂上，男生和女生在一个教室听讲。'
                ],
                '_place' => [
                    'name' => '德黑兰大学',
                    'name_en' => 'University of Tehran',
                    'lat' => 35.702324,
                    'lng' => 51.393528,
                    'info' => [
                        'intro' => '1979 年妇女节，人们从这里出发，抗议压迫。',
                        'fromto' => 'to',
                    ]
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_dao_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,
                'year' => '1300',
                'sig' => 2,

                'order' => $column_no_start,
                'title' => '儒教在朝鲜半岛',
                'sub_title' => '陪伴佛陀千年后 朱子学接任新国教',
                'slug' => 'Confucianism-Korean-Peninsula',
                'desc' => '佛教和儒家同时来到朝鲜岛，统治者选择佛教做国教。但在 1000 多年后，新生的朱子学兴起，替代了佛教。这段时间，南宋末年和元朝末年大批官宦逃亡朝鲜，其中的知名人物之一是朱熹曾孙朱潜，其家族繁衍到今天已有十几万人后裔。',
                'body' => '佛教和儒家同时来到朝鲜岛，统治者选择佛教做国教。但在 1000 多年后的高丽王朝末年，不满者以新生的朱子学为武器叫板佛教，最终取而代之，史称百年革命。这段时间，朝鲜半岛接收了南宋末年和元朝末年大批逃亡的文人官宦，其中的知名人物之一是朱熹曾孙朱潜，其家族繁衍到今天已有十几万人后裔。',
                'body_long' => '_',
                'author' => 'scil（编）',
                'author_id' => 1,
                'origin' => '',
                'origin_date' => '2017/07/28',
                'show_date' => true,
                'origin_url' => null,
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/04/04',
                'copyright' => '',

                '_image' => [
                    'url' => 'http://world.people.com.cn/NMediaFile/2016/0316/MAIN201603162136000232869000385.JPG',
                    'local' => '/img/2016/韩国成均馆举行春季祭孔仪式.JPG',
                    'alter' => null,
                    'style' => null,
                    'alt' => '成均馆举行春季祭孔仪式',
                    'intro' => '成均馆举行春季祭孔仪式',
                ],
                '_place' => [
                    'name' => '成均馆大学',
                    'name_en' => 'Sungkyunkwan University',
                    'url' => 'skku.edu',
                    'lat' => 37.4959546,
                    'lng' => 126.6926932,
                    'oldOrPoint' => [
                        'type' => 'point',
                        'name' => '朝鲜王朝成均馆',
                    ],
                    'info' => [
                        'fromto' => 'to'],
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_dao_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '「中华文明五千年」的来历',
                'slug' => 'Chinese-civilization-5000-years',
                'year' => -1380,
                'sig' => 2,
                'desc' => '五千年算法的起始点是神话传说，今天有些人试图用「学术」来证明。',
                'body' => '五千年算法的起始点是神话传说，今天有些人试图用「学术」来证明。',
                'body_long' => '_',
                'author' => 'scil(编)',
                'origin' => '',
                'origin_date' => '2016/10/10',
                'show_date' => true,
                'origin_url' => '',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/05',
                'copyright' => '',

                '_image' => [
                    'url' => 'https://wx4.sinaimg.cn/mw690/006pAIj4gy1frrwz5pegvj30dw07e763.jpg',
                    'local' => '/img/2016/中华文明探源工程研究成果.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '',
                ],
                '_place' => [
                    'name' => '敦煌莫高窟',
                    'lat' =>40.0622035,
                    'lng' => 94.7019287,
                    'info' => [
                        'title' => '敦煌藏经洞，是一个多种语言的图书馆',
                        'intro' => '于阗语用古印度婆罗米字母标注，属印欧语系、伊朗语族。',
                        'fromto' => null,
                    ]
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_dao_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '八国联军“暴行”：全城禁止随地大小便',
                'slug' => 'Eight-Nation-Alliance-Commit-No-Nuisance',
                'year' => 1900,
                'sig' => -1,
                'desc' => '过去的北平，「满街都是屎尿」，直到八国联军吓跑统治者，种下了公共卫生的种子。',
                'body' => '清末北平「满街都是屎尿」。1900 年，统治北京 256 年的满清人把城市丢给新的力量，公共卫生开始启程：「美界内，各巷口皆设公厕，任人方便，并设立除粪公司，挨户捐钱，专司其事。德界无人倡办，家家颇甚受难」，「在街上出恭，一经洋人撞见，百般毒打，近日受此凌辱者，不可计数」，「英美各界，均有公捐土车，挨门装运。惟德界无人倡率此举，似亦缺事耳。」。次年春夏之际，联军陆续撤离。北京市民再度获得随地大小便、随处堆放垃圾的自由。只有若干公厕幸存了下来，但埋下了公共卫生的种子。',
                'body_long' => '_',
                'author' => '谌旭彬',
                'origin' => '',
                'origin_date' => '2016/10/10',
                'show_date' => true,
                'origin_url' => 'http://view.news.qq.com/original/legacyintouch/d553.html',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/05',
                'copyright' => '',

                '_image' => [
                    'url' => 'http://www.southcn.com/news/community/shzt/newyear/snowpic/200412310721_467271.jpg',
                    'local' => '/img/2016/故宫雪景.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '',
                ],
                '_place' => [
                    'name' => '北京市椿树街道办事处',
                    'lat' => 39.8931512,
                    'lng' => 116.3485814,
                    'oldOrPoint' => [
                        'type' => 'point',
                        'name' => '丛桂山房',
                        'addr' => '宣武城南椿树二巷',
                        'comment' => ' 仲芳氏《庚子记事》 记录于宣武城南椿树二巷寄寓丛桂山房之南窗',
                    ],
                    'info' => [
                        'title' => '记录',
                        'intro' => '一位读书人居住在这里，在日记中记录了颇多联军强迫北京市民改变陋习的情形',
                        'fromto' => 'to',
                    ]
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
//            [
//                '_slug' => 'fan_dao_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '',
//                'slug'=>'',
//                'body' =>
//                    '@日本零距离 ：李碧华在《荔枝债》里说：“再没有任何一个地方比日本京都更像魂牵梦萦的长安了。” ',
//                'author' => '',
//                'origin' => '',
//                'origin_date' => '2015/08/26',
//                'show_date' => false,
//                'origin_url' => '',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
//            [
//                '_slug' => 'fan_dao_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '新的 Uber 中国 App 不再支持盲人使用',
//                'slug'=>'新的 Uber 中国 App 不再支持盲人使用',
//                'body' =>
//                    '
//如何看待滴滴收购 Uber 后推出的新 Uber 中国 App 不再支持盲人使用？修改
//(4 封私信 / 99+ 条消息) 如何看待滴滴收购 Uber 后推出的新 Uber 中国 App 不再支持盲人使用？ - 知乎
//https://www.zhihu.com/question/52335819
//Uber因歧视盲人乘客而被告上法庭
//Uber因歧视盲人乘客而被告上法庭_IT与交通_cnBeta.COM
//http://www.cnbeta.com/articles/387151.htm
//
//',
//                'author' => '',
//                'origin' => '',
//                'origin_date' => '2016/11/05',
//                'show_date' => false,
//                'origin_url' => 'http://weibo.com/1421881031/EgbE20ftE',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
//            [
//                '_slug' => 'fan_dao_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '虽远必诛',
//                'slug'=>'虽远必诛',
//                'body' =>
//                    '乌托国有一重臣之子，在凹洲买了一幢豪宅。公子爷要将豪宅推平重建，但凹洲住建部官员说，百年以上房子不能拆。不久，凹洲贸易部发现，出口到乌托国的商品，通通被滞留在港口。于是凹洲住建部特批[^1]，允许公子爷铲平百年建筑。太史公曰：犯~~我~~公子爷者，虽远必诛。 <z-editor>（凹洲历史二百多年，百年房子真的蛮老的。这个乌托国是邪恶的美帝吧，公子爷是军火商或犹太资本家的儿子吧。）</z-editor>
//
//[^1]: 另一说：政府拒绝改建申请。聘请律师上诉，获得了州法官的批准。
//',
//                'author' => '上海碩鼠',
//                'origin' => '',
//                'origin_date' => '2016/11/05',
//                'show_date' => false,
//                'origin_url' => 'http://weibo.com/1421881031/EgbE20ftE',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
        ]);

//        $items=
        array_merge($items, [

            [
                '_slug' => 'fan_ren_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '鉴真偷渡弘法',
                'year' => 753,
                'sig' => -1,
                'slug' => 'Jianzhen-smuggle',
                'desc' => '东晋时，婆罗门出身的佛陀耶舍在长安与人合作译出《四分律》，这是一本戒律书。唐代鉴真(がんじん)就是一位精通戒律的和尚，他历经十年难险，终于到达日本，使戒律正式在日本生根。鉴真圆寂后，日本遣使到扬州报丧。',
                'body' => '鉴真是一个精通戒律的“律师”，遵循的根本典籍是印度戒律书之一《四分律》，此书是东晋时，由婆罗门出身的佛陀耶舍在长安与人合作译出。鉴真不惧「沧海淼漫，百无一至」，接受日本僧人的邀请，几次冒险偷渡，终于在 753 年成功，使戒律正式在日本生根。鉴真(がんじん)到日本后第十年，圆寂于招提寺讲经堂，春秋七十又七，一年后，日本遣使到扬州报丧。扬州僧众皆着丧服三日，以纪念这位不畏艰难东渡弘法的伟人。',
                'body_long' =>
                    '鉴真大和尚(がんじん)，俗姓淳于，武则天垂拱四年（688 年）生于广陵（今扬州）江都县。年十四，随父到大云寺游览，看见宏大的佛像，深受感动，于是出家。「开元二十一年（732 年），时大和尚年满四十六，淮南江左净持戒者，唯大和尚独秀无轮，道俗归心，仰为受戒之大师。」

天宝元年（742 年），在唐留学十年的日本僧人荣睿和普照回囶途径扬州，适值鉴真在大明寺讲律，参听之后，十分心折，恳求鉴真东渡弘法。

当时船舶简陋，航海技术，远没有今天发达，日本十七次遣唐使中，海上遇难而沉船就达八次之多，所谓「彼国太远，生命难存，沧海淼漫，百无一至」。但是已五十五岁的鉴真毅然决然：「是为法事也，何惜生命！诸人不去，我即去耳！」

此后几年，因官府禁阻、风浪险恶等原因，鉴真四次履险东渡皆告失败。

天宝七年，鉴真率领一行三十五人的船队，自扬州新河出航。但在下至常州的狼山附近时，风向转变，船只周旋于三山之间。及至进入东海，则又「风急波峻，水黑如墨，沸浪一透如上高山，怒涛再至，似入低谷」。船只在茫茫的大海中漫无目的的漂流，有时要遭受海鸟的侵袭「鸟大如人，飞及舟上，舟重欲没，人以手推，鸟即衔手」。有时要遭受饥馑的煎熬「舟上无水，嚼米喉干，咽不入，吐不出，饮咸水，腹即胀」。就这样，船上的人，支撑了十四个昼夜，终于漂流到了海南岛。后来船队离开海南岛，经广东雷州，广西梧州，江西吉州等地，辗转过江，重回到扬州。此次挫折，水陆往返两万里，日本僧人荣睿病逝于广东端州，鉴真的大弟子祥彦也在吉州圆寂，而鉴真自己则因在南方受了暑热，「眼光暗昧」，又为庸医误诊，遂至双目失明（学者安藤更生认为鉴真是白内障治疗不当而失明），备受艰苦。

鉴真返回扬州后，仍主持龙兴寺，并继续在龙兴、崇福、大明等佛寺讲经说法。

天宝十二年（753）十月，鉴真再次受日本遣唐使恳请，东渡日本。相随的弟子有法进、思托、义进以及日本僧人普照等二十五人。同年十二月二十日，鉴真的船队安全抵达日本~~萨摩国的阿多郡~~<ins cite="http://blog.sina.com.cn/s/blog_4bb6557d010008fo.html">萨摩川边郡的秋目(今日本阿多郡秋妻屋浦)</ins>。此时距首次东渡已去十年，鉴真六十六岁。

鉴真到达日本后，为皇室和众僧受戒，广授学徒，讲授戒律。759 年，鉴真带领弟子建成了有名的唐招提寺。

在日十年后，日本天平宝字七年，即唐代宗广德元年，公元 763 年，五月六日，一代宗师结跏趺坐，面西，圆寂于招提寺讲经堂，春秋七十又七，一年后，日本遣使到扬州报丧。扬州僧众皆着丧服三日，以纪念这位不畏艰难东渡弘法的伟人。今天保存在奈良唐招提寺内的鉴真和尚塑像，是由鉴真的弟子思托，在鉴真和尚生前为其所造的木雕脱干漆“等身”像，坐高八十公分，结跏趺坐，静闭双目，面部表情安详。

<ins cite="http://guoxue.ifeng.com/a/20161011/50084483_0.shtml">鉴真是一个“律师”，这个律不是法律，而是戒律，佛门的律师就是律宗的法师。相传佛祖释迦牟尼在圆寂的时候，告诉弟子们要「以戒为师」，所以佛家很讲究戒律，除了不杀生不饮酒等人们熟知的基本戒律之外，还有很多深入复杂的规矩和修行方法，唐代形成的律宗就是专门钻研戒律的宗派。</ins>

律宗的根本典籍是印度戒律书之一《四分律》，东晋时，由婆罗门出身的佛陀耶舍在长安与人合作译出。此书包含各种戒律：四波罗夷法中有淫戒、盗戒、杀戒、妄语戒（假称获得殊胜功德和神通力）；十三僧残法的重罪有故意出精、触妇人身、对妇人说淫秽猥狎之语等。书中还有各种仪式和日常规定，如百众学法涉及服饰、饮食、姿势、行仪等，二十键度包括受戒键度、自恣键度、衣键度、房舍键度等。书中各种戒律往往是<ins cite="http://www.liaotuo.org/fjrw/jsrw/wjy/110988.html">释迦牟尼因种种机缘，随境点化，是在随犯随止中产生的</ins>。譬如五戒中的盗戒，源自檀尼迦比丘，他斫取摩竭国瓶沙王的木材，理由是瓶沙王曾说「沙门婆罗门，草木及水听随意用」，王回应说「我说无主物，不说有主物」。当时城中不信佛的众人讥讽道：出家人「无有惭愧，无所畏惧，不与而取」。世尊立下戒法：「若比丘，若在村落，若闲静处，不与盗心取，随“不与取”法」。“不与取”，指他人未与而自取之，即偷盗。

鉴真师承南山律宗，但他并不持一家之见。鉴真东渡日本携带的律学典籍，囊括了唐代律学的三宗，除了独占优势的南山宗外，还有日光寺法砺的相部宗和西太原寺怀素的东塔宗。鉴真东渡弘法使律宗正式在日本扎根，除了讲授戒律外，也讲天台宗三大部，即《法华玄义》、《法华文句》与《摩诃止观》，他的再传弟子最澄，留唐归囶后成立了日本的天台宗。
',
                'author' => '子不语',
                'origin' => '',
                'origin_date' => '2009/06/07',
                'show_date' => true,
                'origin_url' => 'http://blog.sina.com.cn/s/blog_5fedbe200100duv7.html',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/02',
                'copyright' => '',

                '_place' => [
                    'name' => '招提寺',
                    'name_en' => 'Tōshōdai-ji',
                    'url' => '//www.toshodaiji.jp',
                    'lat' => 34.675561,
                    'lng' => 135.7826393,
                    'info' => [
                        'fromto' => 'to',
                    ]
                ],
                '_image' => [
                    'url' => 'http://stat.ameba.jp/user_images/20141005/16/giovanni-gbb5/3a/d5/j/o0510031113088357451.jpg',
                    'local' => '/img/2016/鉴真东渡日本路线.jpg',
                    'alter' => null,
                    'style' => null,
                    'alt' => '',
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
        ]);


        $this->addQuotes($items);
    }
}
