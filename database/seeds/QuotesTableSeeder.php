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

        File::cleanDirectory($this->freeDir);
        DB::table('quotes')->truncate();

        $book_id = MENU_ITEMS["writing"]['id']; //;
        $zhi_ren_ye_id = MENU_ITEMS["green"]['id'];
        $melody_id = MENU_ITEMS["melody"]['id']; //
//        $si_id=MENU_ITEMS["zhen/think"]; // 15;

        $ren_id = MENU_ITEMS["human/road"]['id'];
        $ren_home = MENU_ITEMS["human/country"]['id'];

        $fan_ren = MENU_ITEMS['two-rivers/walkers']['id'];
        $fan_cai = MENU_ITEMS['two-rivers/assets']['id'];
        $fan_dao = MENU_ITEMS['two-rivers/dao']['id'];
//        $fan_zhi=MENU_ITEMS['/sail/zhi'];

        $items = [
        ];

        $column_no_start = 0;
        $column_id = $melody_id;
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
                ],
                '_image' => [
                    'url' => '//www.fotosay.com/userimages/blogimages/2011/0516/lixiaozhun/04122640093b.jpg',
                    'local' => null,
                    'alter' => null,
                    'style' => null,
                    'alt' => '但丁之舟 by Eugène Delacroix',
                ],

                'order' => $column_no_start,
                'title' => '《神曲》',
                'slug' => 'Divine-Comedy',
                'body' => '有一门课是《神曲》，结果来了个老头子，这个老头子教了一辈子《神曲》，将近40年。他会讲<z-la title="维吉尔"> Virgil </z-la>带<z-lang title="但丁"> Dante </z-lang>游地狱，游完以后要到天堂了， Virgil 就消失了。老头子每次讲到这里都会泣不成声，在课堂上大哭起来，这就是我说的善良。咱们今天有这样的老师吗？他讲了40年，重复了上千遍，可每次讲课还会受不了，眼泪喷出来。',
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
                'title' => '眼中的美学',
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
//                    'url' => '//www.ccln.gov.cn/uploadImage/dangshidagjian/dangshi/dswk/1358147569530.jpg',
//                    'local' => null,
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
        ]);

        /*  book */
        $column_no_start = 0;
        $column_id = $book_id;
        $items = array_merge($items, [
            [
                '_slug' => 'book_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '“蚁族”这词不成立',
                'slug' => '蚁族这词不成立',
                'body' => '“蚁族”实际上是一个不成立的词，它带着旁观者居高临下的傲慢，充斥着一元成功学的庸俗价值观。我的朋友王力，一个毕业没多久的大学生，曾如此表达对这个词的不屑：「每次看到蚁族这种词我都由衷感到愤怒，这个词大张旗鼓的宣传了这样一种价值：一个刚毕业没多久的大学生住在一个狭小的租来的房间里，就是可悲的。去他妈的，我09年毕业的时候，住在办公室里，一个月伙食费300块钱，我从来没觉得自己过得可悲」。
',
                'author' => '宋石男',
                'origin' => '',
                'origin_date' => '2010/07/02',
                'show_date' => false,
                'origin_url' => 'http://ssnly100.blog.163.com/blog/static/115633920106274815168/',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '<img src="//mp.weixin.qq.com/mp/qrcode?scene=10000004&size=102&__biz=MzAxNjU2MzA2OQ==">',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'book_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '不愿再说天明宽慰的话',
                'slug' => '不愿再说天明宽慰的话',
                'body' => '在新年寄语里曾提到，不祝大家富贵，但祝躲过<z-deep cite="//tieba.baidu.com/p/2615860862">特权与不公</z-deep>。这过于乐观的话放在近日不免让人耻笑。不愿再说天明宽慰的话。长夜才刚开始，黑暗中请记得太阳的模样，沉默中不要为魔鬼歌唱。',
                'author' => '网易新闻客户端',
                'origin' => '',
                'origin_date' => '2013/09/26',
                'show_date' => false,
                'origin_url' => '//weibo.com/1974808274/AbbCZaiBp',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '<img src="//mp.weixin.qq.com/mp/qrcode?scene=10000004&size=102&__biz=MzAxNjU2MzA2OQ==">',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],

            [
                '_slug' => 'book_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '不是五毛',
                'slug' => '不是五毛',
                'body' => '我在给某届毕业生上最后一课时，曾掏出五毛钱，撕成两半，扔地上，问同学们要吗？没人要。我又掏出一百元，撕成两半扔地下，说你们要吗？ 一大群人举手。我就说，你们都是那一百元，即使被撕烂，即使被猥琐的教育制度所伤害，要记得你们仍是那一百元。一百元就是一百元，不是五毛。
',
                'author' => '宋石男',
                'origin' => '',
                'origin_date' => '2010/07/02',
                'show_date' => false,
                'origin_url' => 'http://ssnly100.blog.163.com/blog/static/115633920106274815168/',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '<z-wechat title="四一哥">songshinan41</z-wechat>',

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
        ]);
        /*  si */
//        $column_no_start =0;
//        $column_id=$si_id;
        $items = array_merge($items, [
            [
                '_slug' => 'si_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '我应该谢谢你',
                'slug' => '我应该谢谢你',
                'body' => '大学 4 年<ins>（1979 - 1982）</ins>~~中~~，我有 3 年半~~的时间~~与留学生住在一起。
                
一次~~是~~我在足球比赛中受伤，~~撕裂了大腿肌肉，~~疼痛难忍，夜不能寐。大约后半夜两点~~左右~~，我的房门被轻轻叩响，一位瘦削斯文的英国同学出现在门口，手中拿着一个精致的小木盒。他用还不熟练的汉语对我说：「很对不起，这么晚来打搅你。我刚从外面回来，听说你受了伤，我想你现在一定很难受。这里有一盒我从英囶带来的专治肌肉撕裂的药，效果不错，请你试试吧。」

尽管他的发音不准，讲的也并不流利，可在我听来，却是世界上最美妙最动人的表达。我不知如何表达内心的感受，只是机械地重复着「谢谢！谢谢！」不想这位英国“绅士”在感动之上又给了我新的感动，他说：「其实，我应该谢谢你。」

「为什么？」我万分不解。

他似乎有些激动地说：「因为，你是第一个不问价钱接受我帮助的中囶人。」

说完，便带着十足英囶式的自豪与满足转身走了，留给我一个全新的“致谢观”和对人生、金钱、社会的深深思考。',
                'author' => '朱铁志',
                'origin' => '《杂文选刊》2007 年 02 期（上）.本土“留学”散记',
                'origin_date' => '2007/02/01',
                'show_date' => false,
                'origin_url' => 'http://blog.sina.com.cn/s/blog_62c5cbd50100jp9m.html',
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
                'body' => '相信好人也罢，相信长官也罢，二者其实是一样。总之，把自己的命运交给别人，甚至交给某一个两个人，自己一点也不动脑筋，只是相信别人，那太危险了。碰巧这一两个人是林彪、江青之类，那就更糟了。好人做好事，不错；好人做错事，怎么办？至于坏人呢？坏人做起坏事来，不只是一件、两件啊！',
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

                '_place' => [
                    'name' => '克拉玛依友谊馆',
                    'lat' => 45.600785,
                    'lng' => 84.865811,
                    'info' => [
                        'place_name' => '「我呢就没有管，我说，走，走人」',
                        'deep' => 'member',
                        'intro' => '[徐辛紀錄片截图](http://wx2.sinaimg.cn/bmiddle/643c6f05ly1fe647zd1g4j20go2chn5e.jpg)里的女教师說當時「一下子全场就站起来」，「穿着皮衣的这个同志就说『坐下，讓領導先走』。我呢就没有管，我说，走，走人，我们的学生马上就站起来了」她带学生逃走，她儿子葬身火海。',
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
                'title' => 'Forever a fighter, not a victim',
                'slug' => 'Forever-a-fighter-not-a-victim',
                'body' =>
                    '看到一女孩肩后纹身写着：“宁做战士，不做受害人。”（ Forever a fighter, not a victim ).   
Don\'t be a victim 已成美囶人共识。它的意思不是要人去和人争和人斗，而是在任何关系里面，不老是把自己放在“受害人”的角色之下。它相信人每一步皆有个体选择的自由，而不是等着他人来改变、解救自己。',
                'author' => '方柏林',
                'origin' => '',
                'origin_date' => '2015/09/08',
                'show_date' => false,
                'origin_url' => '//weibo.com/1894493187/CzD5VkcTt',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_place' => [
                    'name' => '哈丽特·塔布曼童年的家',
                    'name_en' => 'Harriet Tubman Childhood Home',
                    'addr' => 'Dorchester County, Maryland',
                    'lat' => 38.4089125,
                    'lng' => -76.3014093,
                    'info' => [
                        'place_name' => '哈丽特·塔布曼一出生就是奴隶',
                        'intro' => '1849年，面对被主人卖出的命运，奴隶塔布曼拒绝丈夫的劝阻，只身逃亡。她说："[T]here was one of two things I had a right to, liberty or death; if I could not have one, I would have the other."',
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
                'title' => '在中囶人梦里最牛逼的人是什么人呢？',
                'slug' => 'American-style-values',
                'body' =>
                    '美囶梦对等级是没有很强的、发自内心的尊重。但是中囶人的梦呢，对既定的等级有一种敬畏。~~我们~~++中囶人++吹牛说看到哪个官怎么摆谱，谈得非常津津有味，都是仰视。梦里想的是“取而代之”，而对怎么**奋斗、创新**，其实~~大家~~++中囶人++是不太关心的。比如说在美囶，小孩子跟家长聊天，说我崇拜一个人，那要说是**因为这个人做了什么东西**。但中囶家庭，在同样的话题下，我的感觉是很少有人会注意到“**贡献**”这个问题。~~大家~~++中囶人++更多讲那个人买了什么车，买了什么房子，家长也是这样。在中囶人梦里最牛逼的人是什么人呢？是不付出努力而能够得到很多的人，这是最高目标。

其实很多大学生、搞研究的也是这样。都说这个大学、那个学者厉害，但是如果我们问他，这些大学、学者到底做了工作，有什么贡献，和你现在要做的事情有什么实质关系，不一定能讲清楚。都是抱着五颜六色的泡泡在飘，都想挤到~~大家~~++中囶人++认可的泡泡里来。而不是去想这个系统是不是合理，该怎么去**改变**。

当然，~~大家~~++中囶人++这么想，首先是因为觉得改变++中国++系统太难了。',
                'author' => '项飙',
                'origin' => '',
                'origin_date' => '2017/05/07',
                'show_date' => false,
                'origin_url' => 'https://zhuanlan.zhihu.com/p/26800369',
                'origin_tip' => null,
                'editor_id' => 1,
                'copyright' => '',
                '_place' => [
                    'name' => '',
                    'name_en' => 'Pocantico Hills, New York',
                    'lat' => 41.0945388,
                    'lng' => -73.8534774,
                    'info' => [
                        'place_name' => '2017 年，D·洛克菲勒辞世',
                        'intro' => 'D·洛克菲勒14 岁时，父亲与他制定零用钱处理细则，规定：双方同意至少20%的零用钱将用于公益事业',
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
                    'url' => 'http://ccm.ddcdn.com/ext/photo-s/07/71/b1/88/aung-san-suu-kyi-house.jpg',
                    'local' => null,
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


        /*  fan ren */
        $column_no_start = 0;
        $column_id = $fan_ren;
        $items = array_merge($items, [
            [
                '_slug' => 'fan_ren_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '先人们的足迹 —— 闯荡亚欧非的 M168',
                'slug' => 'M168',
                'desc' => '如果问华人的祖先是谁？有人会说，北京人。但是，北京人在晚期智人还没有走出非洲时就已经灭绝了。',
                'body' => '如果问华人的祖先是谁？有人会说，北京人。但是，北京人在晚期智人还没有走出非洲时就已经灭绝了。几百万年以来，一批一批的非洲人走出故乡，但全都灭绝了，除了现代人类这只奇葩。人类分子学证明，现代人类无论黄白黑人种，其实是完完全全的一个物种，有着共同的祖先。男性染色体 XY，Y 随男性代代相传。通过分析全球人类染色体的突变节点和节点的产生时间，可以看出整个人类的大致演变过程。12 万年前，Y 染色体突变产生 M168 ，携带者是绝大多数欧亚人的祖先，所以也叫作“欧亚亚当”。相对于元谋人、北京直立人来说，今天的所有东亚人是后来的殖民者，没有什么「自古以来」。',
                'body_long' => '_',
                'author' => '安森垚、超级无敌摩托车',
                'origin' => '知乎 2016',
                'origin_date' => '2016/10/01',
                'show_date' => true,
                'origin_url' => 'https://www.zhihu.com/question/33526473',
                'origin_tip' => null,
                'created_at' => '2017/04/01',
                'editor_id' => 1,
                'copyright' => '',

                '_place' => [
                    'name' => 'M168 起源于 East Africa',
                    'name_en' => '',
                    'lat' => 4.963217,
                    'lng' => 36.422387,
                ],
                '_image' => [
                    'url' => 'http://ngm.nationalgeographic.com/ngm/0603/feature2/images/mp_full.2.jpg',
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
                'title' => '鉴真偷渡弘法',
                'slug' => 'Jianzhen-smuggle',
                'desc' => '「沸浪一透如上高山，怒涛再至，似入低谷」历经千难万险，鉴真(がんじん)终于到了日本，使戒律正式在日本扎根。',
                'body' => '鉴真(がんじん)到日本后第十年，圆寂于招提寺讲经堂，春秋七十又七，一年后，日本遣使到扬州报丧。扬州僧众皆着丧服三日，以纪念这位不畏艰难东渡弘法的伟人。鉴真是一个精通戒律的“律师”，遵循的根本典籍是印度戒律书之一《四分律》，此书是东晋时，由婆罗门出身的佛陀耶舍在长安与人合作译出。鉴真不惧「沧海淼漫，百无一至」，接受日本僧人的邀请，几次冒险偷渡，终于在 753 年成功，使戒律正式在日本扎根。',
                'body_long' =>
                    '鉴真大和尚(がんじん)，俗姓淳于，武则天垂拱四年（688 年）生于广陵（今扬州）江都县。年十四，随父到大云寺游览，看见宏大的佛像，深受感动，于是出家。「开元二十一年（732 年），时大和尚年满四十六，淮南江左净持戒者，唯大和尚独秀无轮，道俗归心，仰为受戒之大师。」

天宝元年（742 年），在唐留学十年的日本僧人荣睿和普照回囶途径扬州，适值鉴真在大明寺讲律，参听之后，十分心折，恳求鉴真东渡弘法。

当时船舶简陋，航海技术，远没有今天发达，日本十七次遣唐使中，海上遇难而沉船就达八次之多，所谓「彼国太远，生命难存，沧海淼漫，百无一至」。但是已五十五岁的鉴真毅然决然：「是为法事也，何惜生命！诸人不去，我即去耳！」

此后几年，因官府禁阻、风浪险恶等原因，鉴真四次履险东渡皆告失败。

天宝七年，鉴真率领一行三十五人的船队，自扬州新河出航。但在下至常州的狼山附近时，风向转变，船只周旋于三山之间。及至进入东海，则又「风急波峻，水黑如墨，沸浪一透如上高山，怒涛再至，似入低谷」。船只在茫茫的大海中漫无目的的漂流，有时要遭受海鸟的侵袭「鸟大如人，飞及舟上，舟重欲没，人以手推，鸟即衔手」。有时要遭受饥馑的煎熬「舟上无水，嚼米喉干，咽不入，吐不出，饮咸水，腹即胀」。就这样，船上的人，支撑了十四个昼夜，终于漂流到了海南岛。后来船队离开海南岛，经广东雷州，广西梧州，江西吉州等地，辗转过江，重回到扬州。此次挫折，水陆往返两万里，日本僧人荣睿病逝于广东端州，鉴真的大弟子祥彦也在吉州圆寂，而鉴真自己则因在南方受了暑热，「眼光暗昧」，又为庸医误诊，遂至双目失明（学者安藤更生认为鉴真是白内障治疗不当而失明），备受艰苦。

鉴真返回扬州后，仍主持龙兴寺，并继续在龙兴、崇福、大明等佛寺讲经说法。

天宝十二年（753）十月，鉴真再次受日本遣唐使恳请，东渡日本。相随的弟子有法进、思托、义进以及日本僧人普照等二十五人。同年十二月二十日，鉴真的船队安全抵达日本~~萨摩国的阿多郡~~<ins cite="http://blog.sina.com.cn/s/blog_4bb6557d010008fo.html">萨摩川边郡的秋目(今日本阿多郡秋妻屋浦)</ins>。此时距首次东渡已去十年，鉴真六十六岁。

鉴真到达日本后，为皇室和众僧受戒，广授学徒，讲授戒律。759 年，鉴真带领弟子建成了有名的唐招提寺。

在日十年后，日本天平宝字七年，即唐代宗广德元年，公元 763 年，五月六日，一代宗师结跏趺坐，面西，圆寂于招提寺讲经堂，无疾而终，春秋七十又七，一年后，日本遣使到扬州报丧。扬州僧众皆着丧服三日，以纪念这位不畏艰难东渡弘法的伟人。今天保存在奈良唐招提寺内的鉴真和尚塑像，是由鉴真的弟子思托，在鉴真和尚生前为其所造的木雕脱干漆“等身”像，坐高八十公分，结跏趺坐，静闭双目，面部表情安详。被日本奉为囶宝。

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
                ],
                '_image' => [
                    'url' => 'http://stat.ameba.jp/user_images/20141005/16/giovanni-gbb5/3a/d5/j/o0510031113088357451.jpg',
                    'local' => '/img/2016/鉴真东渡日本路线',
                    'alter' => null,
                    'style' => null,
                    'alt' => '',
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
                'slug' => 'Joseph-Pierce',
                'body' => 'Joseph Pierce，1842 年生于中囶广东。10 岁时，他被一位船长带到美囶抚养(或是其家人把他卖给了船长)，是年咸丰二年、太平天国二年，。

南北战争爆发后，20 岁的 Pierce 入伍。1863 年 7 月参与葛底斯堡遭遇战后，他志愿参加了第二天的新一场战斗，因此役战功任职士官，是为数不多且事迹可查的早期美囶华裔军人之一。随后，他被派往 New Haven 从事招兵工作，1864 年 9 月归队（东亚太平天国都城刚刚陷落，此时他去祖囶 22 年）。

Pierce 退伍后定居 Meriden, Connecticut，与 Martha Morgan 女士结婚，生二女二子，73 岁辞世，葬于胡桃木墓园（Walnut Grove Cemetery）。当地报纸上刊登了他的讣告，介绍他是「知名且受人喜爱的」（well know and liked）。',
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
                    'url' => '/img/2016/Corporal_Joseph_Pierce.jpg',
                    'local' => null,
                    'alter' => null,
                    'style' => "width:240px",
                    'alt' => '约瑟夫·皮尔斯下士戎装照',
                ],

                '_place' => [
                    'name' => '梅里登',
                    'name_en' => 'Meriden, Connecticut',
                    'lat' => 41.5371748,
                    'lng' => -72.8719198,
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
                'title' => '秦囶客栈',
                'slug' => 'Qin-inn',
//                'limit_height'=>true,
                'body' => '-「来碗西红柿鸡蛋面。」<br>-「抱歉，客官，面条要到宋朝才能成形呢。西红柿现在南美洲才有，明朝末年才传入中土。小店目前只有鸡蛋，要不您点一个？」',
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
                'title' => '造纸术：四处传播 多地发展',
                'slug' => 'papermaking-spread-development',
                'desc' => '纸，生在东亚，走在全世界。',
                'body' => '1764 年，法囶经济学家 Turgot 遇到留学的北京人高类思和杨德望，拜托他们回囶后搜集一些资料，其中有部分造纸之类的制造工艺问题。1788 年，美囶 78 岁的富兰克林发表论文，比较中欧制作单面平滑大纸张的方法。他年长乾隆五岁，时任宾夕法尼亚总统，两年后去世。',
                'body_long' => '_',
                'author' => '',
                'origin' => '',
                'origin_date' => '2015/08/26',
                'show_date' => false,
                'origin_url' => '//weibo.com/1412922410/CxBZGBphT',
                'origin_tip' => null,
                'editor_id' => 1,
                'created_at' => '2017/05/03',
                'copyright' => '',
                '_place' => [
                    'name' => '本杰明·富兰克林国家纪念馆',
                    'name_en' => 'Benjamin Franklin National Memorial',
                    'lat' => 39.9582195,
                    'lng' => -75.1751463,
//                    'info' => [
//                        'place_name'=>'富兰克林国家纪念堂（费城）',
//                        'intro' => '',
//                    ]
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
                'title' => '人类医学的源头',
                'slug' => 'origin-of-human-medicine',
                'desc'=>'苏美尔医学演化出众多分支：欧洲西医、南亚印医、中亚波医、东亚中医……',
                'body' => '人类文明的源头是两河流域的苏美尔，人类的医学也最早出现在苏美尔。两河连接东西两端，西边是希腊，东边是印度。生理学上，东西两边都有“气”、“血”这样类似中医的理论，印医还有类似中医“脉”、“穴”之类的概念。西医的重要人物希波克拉底讲究“燥、湿、寒、热”的平衡，主张微调病人整体的生理平衡，充分信任身体的自愈机能，思维方式颇与中医相通，不知两者是否与传播乃至传承关系。

西医、印医，或是民间验方，采用的药物都来自天然的草药、动物、矿物，而且它们在不同地区一直有着传播交流，如《黄帝内经》提到药物「自西方来」，波斯医学哺育了后世的《本草纲目》。治疗疟疾的灵药金鸡纳，由进取的欧洲人从美洲带到欧洲，又带到亚洲，治好了康熙，生动展示了药物传播的大景象。 ',
                'body_long' => '_',
                'author' => '结巢人境（编）',
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
//                    'info' => [
//                        'place_name'=>'富兰克林国家纪念堂（费城）',
//                        'intro' => '',
//                    ],
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
                // todo
                // 今天听了1件3观炸裂的事，我1个好 http://weibo.com/5874683697/FjXHPzhNn?from=page_1005055874683697_profile&wvr=6&mod=weibotime
                // 我觉得很有意思，说到替代疗法    http://weibo.com/5874683697/Fk3Vpu0r7?ref=home&rid=14_0_8_2669680907410231991&type=comment
            ],
            [
                '_slug' => 'fan_cai_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '把西医拉下神坛——人类医学从古医到新医',
                'slug' => 'modernization-of-human-medicine',
                'desc'=>'新医（现代医学）打败西医，造福人类。',
                'body' => '哥白尼天文学颠覆了西方天文学，西方医学的没落则是由维萨留斯和帕拉塞尔萨斯两个革新的人物开始的。维萨留斯的解剖学著作，和哥白尼发表日心说，同在 1543 年发表，从最根本处拔起了千多年的西方医学的权威。帕拉塞尔萨斯，是一个博学而具原创精神的药物学家和化学家．被后世奉为药物学之父．他性情热烈狂傲，公开焚烧古代医学家的著作，以示与传统决裂。

今天，我们能了解艾叶、雄黄、柴胡……这些天然植物的毒性，也知道溺水后控水这样的前现代医术，实际上有害无益，全拜学者在现代医学上的研究。今天的现代医学作为一门科学，重视证据，没有教条，不怕质疑，在创新和否定中不断前进，

没有人类的现代医学，甚至也没有人类的前现代医学，老鼠照样活到现在，但人类总是想办法，让同胞活得更好。',
                'body_long' => '_',
                'author' => '结巢人境（编）',
                'origin' => '',
                'origin_date' => '2017/08/28',
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
                    'name' => '巴塞尔',
                    'name_en' => 'Basel',
                    'addr' => '',
                    'lat' => 32.0612026,
                    'lng' => 45.2098982,
                    'info' => [
                        'title' => '1527 年，Paracelsus 在巴塞尔做医师和大学老师',
                        'intro' => '他把 Galen 和 Avicenna 的著作扔到圣约翰节上的篝火里，以显示对传统医学的蔑视。那些著作之于西医，相当于《黄帝内经》《伤寒杂病论》《神农本草经》之于中医。Paracelsus 提出人体本质上是一个化学系统的学说，疾病可能是因为元素之间的不平衡。他反对旧时的万灵药而主张用单一物质作药剂，这样一个转变促进了对于专科疾病的研究，并有助于把有益和有害的药物加以区别。',
                    ],
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
                // todo
                // 今天听了1件3观炸裂的事，我1个好 http://weibo.com/5874683697/FjXHPzhNn?from=page_1005055874683697_profile&wvr=6&mod=weibotime
                // 我觉得很有意思，说到替代疗法    http://weibo.com/5874683697/Fk3Vpu0r7?ref=home&rid=14_0_8_2669680907410231991&type=comment
            ],
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
                    'lng' => -117.9189742
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
                'title' => '加密技术为什么能从美囶传向世界',
                'slug' => 'encryption-spreads-from-America',
                'body' =>
                    '<ins>加密技术是互联网的重要基石。</ins>曾经，加密技术是被美国 government 禁止出口的，其他囶家的人，想要使用这些加密算法，就像要从美国买导弹一样，是不可能的。转机发生在 1995 年，这一年，<z-lang title="加州伯克利大学" lang="en"> University of California, Berkeley </z-lang>研究生 Bernstein 在组织 Electronic Frontier Foundation（电子前线基金会）帮助下，起诉 government。他的主张是发表加密算法，属于 freedom of speech 的一部分，从而受<z-lang title="第一修正案" lang="en"> First Amendment </z-lang>保护，史称 Bernstein v. United States。这个案子进行了 4 年，到 1999 年，<z-lang title="联邦第九巡回上诉法院" lang="en">Ninth Circuit Court of Appeals </z-lang>出了判决，依据<z-lang title="第一修正案" lang="en"> First Amendment</z-lang>，判决 government 禁止公开密码算法违宪。在这之后，各种密码协议和开源算法才从美囶流传出来，被自由使用。

EFF 创建于 1990 年，<ins cite="https://www.eff.org/about">是一个在数字世界保护 civil liberties 的非盈利组织。他们通过 impact litigation, policy analysis, grassroots activism, 和技术发展捍卫 user privacy, free expression, and innovation</ins>。EFF 创始人之一是 Lotus 公司创始人卡普尔，曾经是和比尔盖茨齐名的软件天才。1990 年，当时商业互联网尚未成型，而前瞻的卡普尔意识到未来技术、隐私、法律和政治的冲突，自己出资创建了 EFF。',
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
                ],

                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
        ]);
//            $items =
        array_merge($items, [
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
                'author' => '结巢人境（编）',
                'author_id' => 1,
                'origin' => '',
                'origin_date' => '2015/08/26',
                'show_date' => false,
                'origin_url' => '//weibo.com/1412922410/CxBZGBphT',
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
                'title' => '儒学和朝鲜半岛',
                'slug' => 'Confucianism-Korean-Peninsula',
                'desc' => '朝鲜半岛，从佛教到儒学。',
                'body' => ' 高丽王朝以佛教为国教。高丽末年发生了朱子学取代佛教的百年革命，儒学独尊。巧合的是，这期间，在南宋末年，迎来了朱熹曾孙朱潜，在元末时，又迎来大批文人官宦。这段时间里朱子学逐渐兴盛（主导者是高丽本土人），羽翼丰满后开始向佛教叫板。',
                'body_long' => '_',
                'author' => '结巢人境（编）',
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
                ],
                'status' => 1, 'deep' => 'open',
                'comment' => '',
            ],
            [
                '_slug' => 'fan_dao_' . (++$column_no_start),
                'quoteable_type' => 'App\Column',
                'quoteable_id' => $column_id,

                'order' => $column_no_start,
                'title' => '八国联军“暴行”：天津、北京全城禁止随地大小便',
                'slug' => 'Eight-Nation-Alliance-Commit-No-Nuisance',
                'desc'=>'过去的中囶，「满街都是屎尿」，直到八国联军到北京，终于有了干净的街巷。',
                'body' => '戏曲家齐如山说：「除小商棚摊之外，其余都是大小便的地方，满街都是屎尿。」1900 年，管理北京 256 年的满清人把城市丢给新的入侵者。「在街上出恭，一经洋人撞见，百般毒打，近日受此凌辱者，不可计数」。次年春夏之际，联军陆续撤离。北京市民再度获得随地大小便、随处堆放垃圾的自由。',
                'body_long' =>
                    '戏曲家齐如山说清末北平：「除小商棚摊之外，其余都是大小便的地方，满街都是屎尿。」名妓赛金花：「北京的街道，那时太腌臢了，满街屎尿无人管。」 1898 年王锡彤见天津「道路之污秽，街巷之狭隘，殊出情理外。沿河两面居民便溺，所萃不能张目。」郑观应 1890 年代所见上海：「余见上海租界街道宽阔平整而洁净，一入中国地界则污秽不堪，非牛溲马勃即垃圾臭泥，甚至老幼随处可以便溺，疮毒恶疾之人无处不有，虽呻吟仆地皆置不理，惟掩鼻而过之而已。可见有司之失政，富室之无良，何怪乎外人轻侮也。」

早在 1860 年代，奉旨出洋的斌春、张德彝、志刚等人，已见识过巴黎的「净无尘埃」、英囶厕所的「时时洗涤，极精洁」；1870 年代，奉旨出洋的李圭、刘锡鸿，也已见识过伦敦的「洁净无秽气」，东京的「河渠深广洁净，道路开阔，时时洗涤之，经过处无纤毫秽物也」。

1900 年，因慈禧废黜光绪被外国干涉[^1]，清廷鼓动义和团杀教民、打租界、进北京，6 月 21 日对内发布宣战诏书。汉人督抚密议若清败亡，则独立建国、推选李鸿章为总统[^2]。8 月初，清朝统治者出逃，这时距 1644 年清廷占领北京、开始大肆圈地已过去 256 年（清人祖上第一次在京 60 年，时为金国都城）。

联军先后占领天津、北京并进行管理。时人仲芳记载：「近来各界洋人，不许人在街巷出大小恭、泼倒净桶」，「美界内，各巷口皆设公厕，任人方便，并设立除粪公司，挨户捐钱，专司其事。德界无人倡办，家家颇甚受难」，「在街上出恭，一经洋人撞见，百般毒打，近日受此凌辱者，不可计数」。时任中国海关总税务司的英囶人赫德，曾见到「另一囶人士为了宣扬他们清洁的信条，射杀任何在公众场所便溺的人」。联军控制下的天津，也是同样的情形。天津文化人士储仁逊，曾目睹一名外国士兵在发现一名十余岁的中囶少年随地大便后，用刺刀威胁少年以双手将大便捧至指定之处。

联军不仅仅只关注随地大小便。对京城随地堆放垃圾的现象，也同样深恶痛绝。十二月十八日，仲芳记：「英美各界，均有公捐土车，挨门装运。惟德界无人倡率此举，似亦缺事耳。」

[^1]: [义和团究竟是可恨之人，还是可怜之人？](http://mp.weixin.qq.com/s?__biz=MzIzNTAyODMwOA==&mid=2650206153&idx=1&sn=76f6c694b4e8be47911059d885162627)
[^2]: [义和团](https://zh.wikipedia.org/wiki/义和团运动)

次年春夏之际，联军陆续撤离北京。北京市民再度获得随地大小便、随处堆放垃圾的自由。仲芳氏深感愉悦，于光绪二十七年（1901年）五月十四日记：「城内城外各段地面，即归还步军统领衙门五城巡缉，近日尚称安静，抢盗之案亦不甚多。……各街巷扫街、泼水、点灯、倒土、出恭、夜行等事，暂多松懈，不甚严查究责。究竟我兵同气连枝，互相怜悯，不比洋人横暴耳。」

以上，非欲“丑化囶人”——城市居民排泄物的处理，终究是一项须由政府统筹提供的公共服务。重返京城的清廷，无意继承八国联军留下来的公厕。相比需要政府出资的公厕，他们更喜欢联军留下来的用于维持治安的巡捕制度，以及由道路两侧居民出资、出力维持的路灯制度、道路洒扫制度。 1902 年，《大公报》报道联军离开后的天津：「洋官经理时，街道极为洁净，刻下则粪溺狼藉，又复旧观矣。」1904年，《大公报》又报道，天津街头「来往行人任便当街撒尿，并无人禁止」。联军离开后，北京城公厕稀缺，到 1911 年，北京城区有官建公厕 3 座，私建公厕 5 座。
                    ',
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
                        'intro' => '一位居住在宣武城南椿树二巷“丛桂山房”的读书人，在日记中载有颇多联军强迫北京市民改变随地大小便陋习的情形',
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
                'title' => '有十几年，伊朗女性不用戴黑纱',
                'slug' => 'Iranian-power-and-Iranian-women',
                'desc'=>'伊朗，两次转折，女性摘掉黑纱，又被迫戴起，不戴就是反革命。',
                'body' => '从1963年起，伊朗国王巴列维推行了被称为“白色革命”的一揽子改革计划。巴列维国王改变婚姻法，规定女孩子18岁结婚（以前是9岁就嫁人），还赋予妇女选举权，取消神学教育和伊斯兰教法，提倡妇女去掉黑色面纱，废除男性头巾，突出伊朗历史上雅利安人的作用以淡化伊斯兰教影响。在此背景下，伊朗的社会风气相当开放。

巴列维改革使伊朗经济飞速发展，1968 年 - 1978 年，平均年增长速度为 16─17%，但贫富分化严重，腐败猖獗，连补贴到老少边穷的慈善救助金都有人贪腐。巴列维拒绝权力改革，「自我评价的办法比西方国家必须依靠“忠诚反对派”的办法更加可靠、更加公正」，「为了实现真正的帝国民主，就需要有一个君主从上边进行统一」（[《“白”与“黑”——伊朗的两种“革命”》](http://www.360doc.com/content/15/0808/00/17132703_490226807.shtml)）。1978 年革命爆发，当时所有的西方知识分子都说，这是赶走了一个暴君。美国放弃支持巴列维，霍梅尼搭乘法航专机回到德黑兰掌握了权力。1979年3月7日，霍梅尼违背承诺[^伊朗女性反对]，要求妇女必须带上面纱。次日三八妇女节，德黑兰市区的妇女上街反对这项决定，「因为前一夜政府在报纸上公布女性上班必须佩戴头巾。于是，没人去上班」，「当时的伊朗人民充满了热情和希望，人们还相信能够改变些什么」[^伊朗女性反对]，结果被军队驱散。这年7月起，所有妇女都必须在公开场合带上面纱，否则即被视作反革命行为。电影、戏剧、舞蹈、绘画、雕刻中的女性形象被剔除，不得不出现的女性形象也必须按照伊斯兰教规定加以处置。

Feminists 被装在麻袋里面乱石砸死（[《宗教立法后的伊朗的女性》](http://cul.qq.com/a/20150912/017525.htm)）。

伊朗女性总失业率由 1976 的 6.9% 上升到 1986 年的 25.2%，这期间女性就业总数减少了 86.12 万人。到1996年，伊朗女性就业情况有所好转，但是仍然不及革命前的水平。2011 年，伊朗女性占据了全国总人口的 49.6%，却只有 12.6% 的伊朗女性活跃在劳动力市场，女性失业状况依然堪忧。（[《伊朗伊斯兰革命以来女性失业问题简析》](https://wenku.baidu.com/view/09375dc2581b6bd97e19eaac.html)）

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
                    'url' => 'http://image.tuku.china.com/tuku.culture.china.com/culture/pic/2009-05-04/50d3f235-c1e7-4d8f-954c-48dd6abadfac.jpg',
                    'local' => null,
                    'alter' => null,
                    'style' => null,
                    'alt' => '',
                ],
                '_place' => [
                    'name' => '德黑兰大学',
                    'name_en' => 'University of Tehran',
                    'lat' => 35.702324,
                    'lng' => 51.393528,
                    'info' => [
                        'intro' => '1979 年 3 月 8 日，人们从德黑兰大学开始',
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
//                'origin_url' => '//weibo.com/1412922410/CxBZGBphT',
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


        /*  fan zhi */
        $column_no_start = 0;
//        $column_id=$fan_zhi;
//        $items = array_merge($items, [
//            [
//                '_slug' => 'fan_dao_'.(++$column_no_start),
//                'quoteable_type' => 'App\Column',
//                'quoteable_id' => $column_id,
//
//                'order' => $column_no_start,
//                'title' => '',
//                'slug'=>'',
//                'body' =>
//                    '
//                    ',
//                'author' => '',
//                'origin' => '',
//                'origin_date' => '2016/10/10',
//                'show_date' => true,
//                'origin_url' => 'http://view.news.qq.com/original/legacyintouch/d553.html',
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
//                'title' => '鉴真偷渡弘法',
//                'slug'=>'鉴真偷渡弘法',
//                'body'=>'鉴真(がんじん)是一个“律师”，精通戒律，属律宗。律宗遵循的根本典籍是印度戒律书之一《四分律》，此书是东晋时，由婆罗门出身的佛陀耶舍在长安与人合作译出。鉴真接受日本僧人的邀请，几次冒险偷渡，终于在 753 年成功，使戒律正式在日本扎根。十年后，日本天平宝字七年，即唐代宗广德元年，公元 763 年，五月六日，一代宗师结跏趺坐，面西，圆寂于招提寺讲经堂，无疾而终，春秋七十又七，一年后，日本遣使到扬州报丧。扬州僧众皆着丧服三日，以纪念这位不畏艰难东渡弘法的伟人。',
//                'body_long' =>
//                    '鉴真大和尚(がんじん)，俗姓淳于，武则天垂拱四年（688 年）生于广陵（今扬州）江都县。年十四，随父到大云寺游览，看见宏大的佛像，深受感动，于是出家。「开元二十一年（732 年），时大和尚年满四十六，淮南江左净持戒者，唯大和尚独秀无轮，道俗归心，仰为受戒之大师。」
//
//天宝元年（742 年），在唐留学十年的日本僧人荣睿和普照回囶途径扬州，适值鉴真在大明寺讲律，参听之后，十分心折，恳求鉴真东渡弘法。当时船舶简陋，航海技术，远没有今天发达，日本十七次遣唐使中，海上遇难而沉船就达八次之多，所谓「彼国太远，生命难存，沧海淼漫，百无一至」。但是已五十五岁的鉴真毅然决然：「是为法事也，何惜生命！诸人不去，我即去耳！」
//
//此后几年，因官府禁阻、风浪险恶等原因，鉴真四次履险东渡皆告失败。
//
//天宝七年，鉴真率领一行三十五人的船队，自扬州新河出航。但在下至常州的狼山附近时，风向转变，船只周旋于三山之间。及至进入东海，则又「风急波峻，水黑如墨，沸浪一透如上高山，怒涛再至，似入低谷」。船只在茫茫的大海中漫无目的的漂流，有时要遭受海鸟的侵袭「鸟大如人，飞及舟上，舟重欲没，人以手推，鸟即衔手」。有时要遭受饥馑的煎熬「舟上无水，嚼米喉干，咽不入，吐不出，饮咸水，腹即胀」。就这样，船上的人，支撑了十四个昼夜，终于漂流到了海南岛。后来船队离开海南岛，经广东雷州，广西梧州，江西吉州等地，辗转过江，重回到扬州。此次挫折，水陆往返两万里，日本僧人荣睿病逝于广东端州，鉴真的大弟子祥彦也在吉州圆寂，而鉴真自己则因在南方受了暑热，「眼光暗昧」，又为庸医误诊，遂至双目失明（学者安藤更生认为鉴真是白内障治疗不当而失明），备受艰苦。
//
//鉴真返回扬州后，仍主持龙兴寺，并继续在龙兴、崇福、大明等佛寺讲经说法。
//
//天宝十二年（753）十月，鉴真再次受日本遣唐使恳请，东渡日本。相随的弟子有法进、思托、义进以及日本僧人普照等二十五人。同年十二月二十日，鉴真的船队安全抵达日本~~萨摩国的阿多郡~~<ins cite="http://blog.sina.com.cn/s/blog_4bb6557d010008fo.html">萨摩川边郡的秋目(今日本阿多郡秋妻屋浦)</ins>。此时距首次东渡已去十年，鉴真六十六岁。
//
//鉴真到达日本后，为皇室和众僧受戒，广授学徒，讲授戒律。759 年，鉴真带领弟子建成了有名的唐招提寺。
//
//在日十年后，日本天平宝字七年，即唐代宗广德元年，公元 763 年，五月六日，一代宗师结跏趺坐，面西，圆寂于招提寺讲经堂，无疾而终，春秋七十又七，一年后，日本遣使到扬州报丧。扬州僧众皆着丧服三日，以纪念这位不畏艰难东渡弘法的伟人。今天保存在奈良唐招提寺内的鉴真和尚塑像，是由鉴真的弟子思托，在鉴真和尚生前为其所造的木雕脱干漆“等身”像，坐高八十公分，结跏趺坐，静闭双目，面部表情安详。被日本奉为囶宝。
//
//<ins cite="http://guoxue.ifeng.com/a/20161011/50084483_0.shtml">鉴真是一个“律师”，这个律不是法律，而是戒律，佛门的律师就是律宗的法师。相传佛祖释迦牟尼在圆寂的时候，告诉弟子们要「以戒为师」，所以佛家很讲究戒律，除了不杀生不饮酒等人们熟知的基本戒律之外，还有很多深入复杂的规矩和修行方法，唐代形成的律宗就是专门钻研戒律的宗派。</ins>
//
//律宗的根本典籍是印度戒律书之一《四分律》，东晋时，由婆罗门出身的佛陀耶舍在长安与人合作译出。此书包含各种戒律：四波罗夷法中有淫戒、盗戒、杀戒、妄语戒（假称获得殊胜功德和神通力）；十三僧残法的重罪有故意出精、触妇人身、对妇人说淫秽猥狎之语等。书中还有各种仪式和日常规定，如百众学法涉及服饰、饮食、姿势、行仪等，二十键度包括受戒键度、自恣键度、衣键度、房舍键度等。书中各种戒律往往是<ins cite="http://www.liaotuo.org/fjrw/jsrw/wjy/110988.html">释迦牟尼因种种机缘，随境点化，是在随犯随止中产生的</ins>。譬如五戒中的盗戒，源自檀尼迦比丘，他斫取摩竭国瓶沙王的木材，理由是瓶沙王曾说「沙门婆罗门，草木及水听随意用」，王回应说「我说无主物，不说有主物」。当时城中不信佛的众人讥讽道：出家人「无有惭愧，无所畏惧，不与而取」。世尊立下戒法：「若比丘，若在村落，若闲静处，不与盗心取，随“不与取”法」。“不与取”，指他人未与而自取之，即偷盗。
//
//鉴真师承南山律宗，但他并不持一家之见。鉴真东渡日本携带的律学典籍，囊括了唐代律学的三宗，除了独占优势的南山宗外，还有日光寺法砺的相部宗和西太原寺怀素的东塔宗。鉴真东渡弘法使律宗正式在日本扎根，除了讲授戒律外，也讲天台宗三大部，即《法华玄义》、《法华文句》与《摩诃止观》，他的再传弟子最澄，留唐归囶后成立了日本的天台宗。
//',
//                'author' => '子不语',
//                'origin' => '',
//                'origin_date' => '2009/06/07',
//                'show_date' => true,
//                'origin_url' => 'http://blog.sina.com.cn/s/blog_5fedbe200100duv7.html',
//                'origin_tip' => null,
//                'editor_id' => 1,
//                'copyright'=>'',
//
//                'status' => 1, 'deep' => 'open',
//                'comment' => '',
//            ],
//        ]);


        $this->addQuotes($items);
    }
}
