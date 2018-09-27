<?php

//use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    public function run()
    {
        $this->freeDir = storage_path() . '/free/videos/';
        $this->sourceDir = __DIR__ . '/video_src/';


        $v_col_id = MENU_MAP["video"]['id']; //9;
        $vol_nu = 0;

        DB::table('videos')->truncate();

        $videos = [
            '碧海蓝天' => [
                'english_name' => 'The Big Blue',
                'slug' => 'The-Big-Blue',
                'other_names' => '碧海情深\碧海情',
                'native_name' => 'fr \ Le grand bleu',
                'author' => 'Luc Besson（吕克·贝松）',
                'author_id' => null,
                'time' => '1988',
                'date' => '1988/05/11',
                'desc' => '吕克·贝松（Luc Besson）的经典作品，刻画了大海的深邃迷人，更讴歌了人的纯粹、真挚。',
                'intro' => '热爱潜水的 Jacques，对大海一往情深；他的朋友亚舍也精于潜水，同时对名誉非常看重。一次挑战潜水极限的比赛让他们重逢，生命与海洋之间的对话就此展开。',
                '_relations' => [
                    'vol' => [
                        'title' => 'Big blue',
                        'column_id' => $v_col_id,
                        'no' => ++$vol_nu,
                    ],
                    'behind' => [

                        'quoteable_type' => 'App\Video',
                        'quoteable_id' => 1,
//                        'slug' => 'The-Big-Blue--behind',
                        'body' => '本片倾注了导演对大海深切的热恋和回忆，他 17 岁时因为事故而被迫告别潜水，20 多岁时遇到了本片主人公的原型 Jacques Mayol 。Mayol 1927 年出生在上海，在佛罗里达一家水族馆做潜水员结识海豚 Clown, 在向海豚的学习中形成了自己独特的人生哲学。1966 年他在赛事上结识 Enzo，两人的友谊和竞争由此开始。 Enzo 说「雅克是为海而生的，而我，还是需要陆地。」',
                        'body_long' => '导演卢克贝松 1959 年出生在法国巴黎。幼年时，他是个害羞内向的小孩，从小随当潜水教练的父母在法国南部、地中海、希腊等地的海边渡过他的童年时期。9 岁之后移居巴黎，开始他的城市生活。10 岁时，全家到摩洛哥旅行，他第一次看到海豚，就跳下去和海豚游水。这个惊奇而难忘的经验，同时也成为他最著名的电影《碧海蓝天》的发想点。青少年时期的他著迷於研究海豚的生态和摄影，对他而言，海底的世界是一个比陆地更神秘、迷人的世界。17岁那年，一场因为潜水发生的事故，医生宣告他从此不能潜水。18岁到美国好莱游历、打工，学习电影。1988年，《碧海蓝天》让卢克贝松获得最高的掌声，但是在剪辑这部电影参加坎城影展的时候，他的女儿生病需要动手术，但是他依然坚持完成了这部电影，并把它送给了他的女儿。

这部电影的创作灵感源自真实人物，Jacques Mayol 和 Enzo Maiorca （电影中名为 Enzo Molinari）。Mayol 1927 年出生在上海，他对海豚的情缘起于 1955 年，当时他在佛罗里达一家水族馆做潜水员，和海豚 Clown 成为好友， Mayol 通过模仿向她学习潜水，并逐渐形成了他 Homo Delphinus 的人生哲学（[Jacques Mayol](https://en.wikipedia.org/wiki/Jacques_Mayol)）。1937 年在日本，他第一次遇到了海豚。Enzo 1931 年生于意大利人，1965 年创造了 54 米的世界记录。

1966年，Mayol 结识了 Enzo 并创造了新纪录，两人的友谊和竞争由此开始。 Mayol 参与过人类水中潜力的科学研究，清水时心跳减少到每分钟 27 次， 1976 年他创造了潜入到水下100 米的记录（the first free diver to descend to 100 meters ），1983 年 56 岁的他潜入 105 米。同年 Mayol 结识吕克·贝松，他参与了 *Le grand bleu* 剧本的创作。电影放映 13 年后的2001 年，74 岁的他上吊自杀。法国总统希拉克称赞 Mayol 是 「 Big Blue 时代的远见者，仍然是对绝对追求的象征」（French President Mayol Chirac hailed Mayol as a "visionary, who for the \'Big Blue generation\' will remain as a symbol of the quest for the absolute.）"

Enzo Maiorca 在 90 年代进入政界。<z-lang title=" For many years, he resisted public showing of the film in Italy, as he considered it to caricature him poorly; after Mayol\'s death in 2001 he relented and accepted the showing of the film.">他认为这部电影把他歪曲得滑稽可笑，多年来抵制本片在意大利的放映，Jacques 死后他变得宽和，接受了电影的放映。他是素食者，于 2016 年辞世。</z-lang>([The Big Blue](https://en.wikipedia.org/wiki/The_Big_Blue [Jacques Mayol](https://en.wikipedia.org/wiki/Jacques_Mayol) [Diving legend commits suicide](http://news.bbc.co.uk/2/hi/europe/1726694.stm))

Jacques Mayol’s lifelong passion for diving was based on his love for the ocean, his personal philosophy and his desire to explore his own limits. （[Jacques Mayol](https://en.wikipedia.org/wiki/Jacques_Mayol)） Enzo 曾说「雅克是为海而生的，而我，还是需要陆地。」（[一生一事](https://movie.douban.com/review/7910827/)）',
                        'author' => 'scil（编）',
                        'origin' => '',
                        'origin_date' => '2017/07/10',
                        'show_date' => false,
                        'origin_url' => null,
                        'origin_tip' => null,
                        'editor_id' => 1,
                        'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    'tip' => [

                        'quoteable_type' => 'App\Video',
                        'quoteable_id' => 1,
//                        'slug' => 'The-Big-Blue--tip',
                        'body' => '三个不同长度的版本：168 min (director\'s cut) ;  132 min (original cut) ; 118 min (edited)。1988 年上映之后，影片在欧洲取得了巨大的票房胜利，仅仅在法国影院就涌入了900万观众。然而，贝松在美国并没有延续这种势头，这或许要归咎于影片被重新剪辑的原因。美国版被剪短，原作不明确的暧昧的充满童话意味的结尾被改成了千篇一律的大团圆，更换了埃里克·萨拉充满才气和富有感召力的音乐（这对影片主题的烘托影响巨大）。十年后重新发行，长度大约为三小时（168分钟），这也被公认为贝松的最佳版本。（[《吕克·贝松：是主流，亦是边缘？》](http://blog.sina.com.cn/s/blog_54b5faae0100049s.html)）',
                        'author' => 'scil（编）',
                        'origin' => '',
                        'origin_date' => '2017/07/10',
                        'show_date' => false,
                        'origin_url' => null,
                        'origin_tip' => null,
                        'editor_id' => 1,
                        'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    'image' => [
                        'url' => 'https://img3.doubanio.com/view/photo/s_ratio_poster/public/p455722535.jpg',
                        'local' => null,
                        'alter' => null,
                        'style' => null,
                        'alt' => 'The Big Blue',
                    ],
                    'places' => [
                        [
                            'name' => '托斯卡纳海岸',
                            'english_name' => 'Tuscany coast',
                            'lat' => 43.4660533,
                            'lng' => 9.9623026,
                            'info' => [
                                'intro' => '2001, Mayol\'s ashes were spread over the Tuscany coast.',
                            ]
                        ],
                    ],
                    'quotes' => [
                        [
                            'body' => 'Johanna: <z-lang title="What\'s it feel like when you dive?">潜水时有什么感觉</z-lang><br>
Jacques: <z-lang title="It\'s a feeling of slipping without falling.">好像滑落的感觉。</z-lang> <z-lang title="The hardest thing is when you\'re at the bottom.">最难的是在海底的时候</z-lang><br>
Johanna: Why?<br>
Jacques: <z-lang title="\'Cause you have to find a good reason to come back up... and I have a hard time finding one.">因为要找个理由浮上来 我总是很难找到这个理由</z-lang> ',
                            'origin' => 'director\'s cut  02:15',
                        ],
                        [
                            'body' => '<z-lang title="do you know">你知道</z-lang><br>
<z-lang title="what you\'re supposed to do, to meet a mermaid?">怎么样才能遇见美人鱼吗？</z-lang><br>
<z-lang title="You go down to the bottom of the sea">当你游到海底</z-lang><br>
<z-lang title="where the water isn\'t even blue anymore">那里的水更蓝</z-lang><br>
<z-lang title="where">在那里</z-lang><br>
<z-lang title="where the sky is only a memory">蓝天变成了回忆</z-lang><br>
<z-lang title="and you float there, in the silence">你就躺在寂静里</z-lang><br>
<z-lang title="And you stay there">呆在那里</z-lang><br>
<z-lang title="and you decide, that you\'ll die for them.">决心为她们而死。</z-lang><br>
<z-lang title="Only then do they start coming out. They come, and they greet you, and they judge the love you have for them.">只有这样，她们才会出现，她们来问候你，考验你的爱。</z-lang><br>
<z-lang title="If it\'s sincere, if it\'s pure, they\'ll be with you, and take you away forever.">如果你的爱够真诚，够纯洁，她们就会和你一起，然后把你永远的带走。</z-lang>',
                            'origin' => 'director\'s cut  01:43',
                        ],
                        [
                            'body' => '<z-lang title="Don\'t look at Jaques as if he was a human being, he comes from another planet.">别把雅克当普通人看待 他来自另一个世界</z-lang>',
                            'origin' => 'director\'s cut  00:54',
                        ],
                    ],
                    'comments' => [

                        [
                            '_slug' => 'blue_qi1',
                            'quoteable_type' => 'App\Video',
                            'type' => 'comment',
                            'order' => 1,
                            'body' => '如果你有幸遇见生命的颜色，请拥抱它  
无论是热烈的火焰，还是冰冷的海水  
无论它高悬于天边，还是沉寂于地下  
……  
它存在抑或是不在
',
                            'author' => '九酒久鸠',
                            'author_id' => null, // todo
                            'origin' => '生命的颜色',
                            'origin_date' => '2011-01-15',
                            'show_date' => true,
                            // todo
                            // 本文作者在这里：https://sanwen8.cn/p/16cqwXZ.html
//                            公众号：catmint09
                            'origin_url' => 'https://movie.douban.com/review/4582543/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'blue_qi1',
                            'quoteable_type' => 'App\Video',
                            'type' => 'comment',
                            'order' => 1,
                            'body' => '就像飞行员之于天空，航海家之于大海，登山者之于高山。天空，大海，高山，就是他们生命意义的所在。',
                            'author' => '方方方',
                            'author_id' => null, // todo
                            'origin' => '大海的呼唤',
                            'origin_date' => '2013-05-26',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/5992409/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'blue_qi1',
                            'quoteable_type' => 'App\Video',
                            'type' => 'comment',
                            'order' => 1,
                            'body' => '雅克指着海豚的相片对乔安娜说"This is my family.Who has family like this?"之后，像个孩子一样哭泣，他爱上了乔安娜，在他的世界里不只有大海和海豚，还有一个生活在都市，执着于爱情的女孩，然而他不得不面对一次关于爱的抉择，很多人不能理解，为什么就不能二者并存呢？或许每个人来到世上的使命是不同的，他是属于大海的。',
                            'author' => '宇宙超级无敌铁战士',
                            'author_id' => null, // todo
                            'origin' => 'THE BIG BLUE',
                            'origin_date' => '2006-01-21',
                            'show_date' => true,
                            'origin_url' => '//book.douban.com/review/1400528/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'blue_qi2',
                            'quoteable_type' => 'App\Video',
                            'type' => 'comment',
                            'order' => 2,
                            'body' => '最美的画面莫过于一轮皎洁的明月悬于天际，白色的月光洒在深蓝色的海面上，一切是那么安详宁静，音乐随着海风的低吟缓缓想起，曼妙的旋律荡漾在海面上，回旋于天地间，一只海豚一跃而起，在空中划出优美的弧线，海面上海豚在吟唱，那么和谐美好，吕克贝松把大海拍到了极致，一尘不染的摄影将我们带进宁静、安详的深蓝之中，这份宁静聚合在人心深处，那忧郁的蓝，那动人的乐，无需更多的对白，已经让我陶醉，他向我们展现了最纯粹的人性，那种对生命对梦想真挚坚定的追求，那种不带任何杂质的热爱，让我感动。"dedicated to my daughter Juliette..." 导演最终把这片深蓝色的大海献给了他的女儿.或许成人的世界真的不再纯粹，真的已经淡化了生命的本来面目，那么就让我们带着曾经有过的执着和坚定，孩童般的简单和纯真回到属于自己的碧海蓝天！',
                            'author' => '宇宙超级无敌铁战士',
                            'author_id' => null, // todo
                            'origin' => 'THE BIG BLUE',
                            'origin_date' => '2006-01-21',
                            'show_date' => true,
                            'origin_url' => '//book.douban.com/review/1400528/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'blue_qi3',
                            'quoteable_type' => 'App\Video',
                            'type' => 'top',
                            'order' => 2,
                            'body' => '90年代上海电影译制配音“碧海情深”。  
好多年过去了，自己也长大了。它法语原名Le Grand Bleu其实更贴切  
法国人有多喜欢蓝色呢？法国人觉得自己是Les bleu,他们骄傲的足球队就叫Les bleu  
法国国旗的颜色蓝、白、红分别象征：自由、平等、博爱  
法国人骨髓里无可救药的浪漫，把象征蓝色的自由放在第一位，  
但是如果你看过著名的法国电影"蓝白红---三色曲"就能体会“自由”决不只是一个  
充满享受的词，一个人享受多大的自由就必须承受多大的孤独甚至痛苦  
伟大的蓝，它是既代表自由也是象征孤独和忧郁的双刃剑，  
孤独与自由，只是蓝色的深与浅',
                            'author' => '花橘子叔叔',
                            'author_id' => null, // todo
                            'origin' => '《如果比全世界最孤单的海豚还寂寞》',
                            'origin_date' => '2008-07-25',
                            'show_date' => true,
                            'origin_url' => 'https://book.douban.com/review/4902223/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'blue_qi4',
                            'quoteable_type' => 'App\Video',
                            'type' => 'top',
                            'order' => 3,
                            'body' => '抵达属于自己的碧海蓝天，潜入海底最深处，在最纯净的蓝色里与海共舞。只有海和自己。——这是一部吕克贝松送给女儿的片子，也是一部向所有纯粹而坚定的理想主义者致敬的影片。',
                            'author' => '呢喃（重庆）',
                            'author_id' => null, // todo
                            'origin' => '《我们的碧海蓝天》',
                            'origin_date' => '2008-01-29',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/1292379/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

                    ],
                    'comment_select' => [
                        [
                            'slug' => 'comments-on-The-Big-Blue',
                            'title' => '为什么要潜水？',
                            'intro' => '多数时候我们是在摸着石头过生命这条河。石头又湿又滑，每天我们都活的战战兢兢。我们在意的只是不要掉进河里。可是我们终归是要掉进去的，或早或晚。',
                            'author' => 'scil（编）',
                            'author_id' => 1,
                            'origin' => null,
                            'origin_date' => '2017/4/10',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/1093079/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                    'reviews' => [

                        [
                            'slug' => 'even-if-nothing-but-remoteness-in-the-distance',
                            'title' => '即使远方除了遥远一无所有',
                            'intro' => '颓丧的时候我认定艺术的奢侈和在现实面前的不堪一击。可更多时候却是不得不承认它震撼人心的力量。呈现一切改变一切的力量。',
                            'author' => '黄七阳',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2006-11-23',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/1093079/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                ],// end _relations

            ], // end big blue
            '钢锯岭' => [
                'english_name' => 'Hacksaw Ridge',
                'slug' => 'Hacksaw-Ridge',
                'other_names' => '血战钢锯岭',
                'author' => '',
                'author_id' => null,
                'time' => '2016',
                'date' => '2016-11-04',
                'intro' => 'Desmond T. Doss 童年时因为家庭中的暴力而向上帝发誓永不碰枪，日本袭击美国后，23 岁的 Doss 为信仰和自由而参军，训练中一直能力出色，但在枪械训练时却拒绝踫枪，队友歧视侮辱他，他坚守信念毫不妥协，军队劝退他，他执意参军不肯退出……本片来自于真人事迹',
                '_relations' => [
                    'vol' => [
                        'title' => 'Doss',
                        'column_id' => $v_col_id,
                        'no' => ++$vol_nu,
                    ],
                    'behind' => [

                        'quoteable_type' => 'App\Video',
                        'quoteable_id' => 2,
//                        'slug' => 'The-Big-Blue--behind',
                        'body' => '日军不割掉渔网，是出于“地道战”，歼灭敌人有生力量的现实需要，这也是符合历史事实的',
                        'body_long' => '日军不割掉渔网，是出于“地道战”，歼灭敌人有生力量的现实需要，这也是符合历史事实的。[Saving Private Ryan之后最好的战争片](https://movie.douban.com/review/8162538/)
                
根据[A Hero among Heroes](https://movie.douban.com/review/8220037/)：
1. Mel 拍 Desmond 负伤撤下战场那段已经是对真实情况的极尽简化，他要是一板一眼丝毫不加改编地照着拍，不知道有些观众是不是要大呼“老美就是会煽情”或美帝伟光正英雄主旋律大片什么的。实际的情况在他的MoH嘉奖令里写得清楚明白：Desmond 救护伤员直至腿部被手榴弹炸伤，之后并未如电影里那样马上被抬走，也没有喊叫掩体后的医护兵来救他（这样做会危及医护兵的生命），而是自己给自己包扎伤处，等了五个钟头等到担架兵找到他把他抬走，在抬走去安全处的路上又遭遇日军坦克攻击，尔后他见到一个伤势更严重的伤兵，就让出担架床，指挥担架兵先把这个战友送走。在等担架兵返回时他被另一个战友带走，路上又被日军狙击手打中一只手臂造成骨折，他用枪托当夹板固定好伤臂后自己在崎岖的地面上爬了数百码回急救站（此时他腿上至少有十七块弹片[真实的道哥比电影更传奇](https://movie.douban.com/review/8162745/)）。在冲绳战役里他数度负伤，紫心拿了三次。在之前的关岛战役他就因救援伤员获得铜星，在莱特岛染上结核病，这些伤病对他的身体造成很大损伤（电影里没有提到）（身体90%伤残，肋骨和肺损坏，花了五年半治疗，但过量的抗生素又使他失聪很多年[《血战钢锯岭》之电影与现实的对比](https://movie.douban.com/review/8220093/)）。荣誉勋章是嘉奖45年4月29日~5月21日期间的英勇救护伤员行为，数度暴露在敌人火力下却没有死，也许真的应该认为，God guided and protected him, and he\'s the guardian angel to his buddies。
2. 国会荣誉勋章（Medal of Honor）是美国至高无上的军事荣誉，美军最顶级勋章，对等英军的维多利亚十字勋章（Victoria Cross），二战中美军全军只颁发出464枚MoH，其中266枚为死后追授，活着受勋的只有小半数，266这个数字还不包括一些授予当时没挂、之后在别的战役里挂了的，比如USMC的巴斯隆，他在瓜岛获得MoH，授勋仪式在之后墨尔本休整期间，后来在硫磺岛战役里牺牲；101空降师的R.G.Cole中校在诺曼底战役荣获MoH，在荷兰战役阵亡，因为身在前线，到死都没摸到过自己的勋章（霸王行动有“一师一章”的名额限制，他的受勋导致506团2营E连的Winters中尉被推荐MoH却只能降等为DSC）。血腥的贝里琉战役陆战一师得到8枚MoH，其中五人为追授。可见MoH作为全军最高荣誉获得之艰难。理所当然，top honor needs extreme bravery and great sacrifice！而美军的荣誉勋章也跟英军的维多利亚十字勋章一样很重视嘉奖士兵在战场上英勇救护同袍的行为（次级勋章也一样重视这点），二战之后的现代战争里，尤其是越战之后，荣誉勋章颁发数量很少，从这些有限的授勋事迹来看，其中相当大比例的recipients是因为战场上的救护行为而受勋：……其实救护同袍的例子在全军非常多，但很多人的事迹并不为大众所知，也很难像 Desmond Doss这么开挂一个人救护这么多人。可是一个军人在战场上舍己为人这种情况是很多见的，读书时读到这些人的事迹，真是无法不被感动和肃然起敬。

下面节选整理自[《血战钢锯岭》之电影与现实的对比](https://movie.douban.com/review/8220093/) 和 [《血战钢锯岭》和真实历史良心拒服兵役事件的出入](https://movie.douban.com/review/8215330/):
1. Maeda悬崖（电影中的钢锯岭）是一座横跨冲绳岛的山脊，高达350英尺（106米），日军在上面布满了暗道，并进行了伪装。总共救了多少人？自己估计50人，长官给他邀功100人，最后取中间值75人。救人时身边多次近距离的爆炸，但最后死里逃生好几次。Doss 花费12小时时间救了75人，平均约每10分钟救出一人。
2. 关于法庭审判 电影中他父亲来救场。现实中没有。「长官们召开听证会，希望以精神问题为由开除他。但是他们也知道，如果只是宗教原因，华盛顿方面是不可能赞成这次开除的，所以最后妥协了。」「Capt. Cunningham威胁把他送上军事法庭，但被另一名长官制止了。不过后来Capt. Cunningham没有批准他回家探亲的休假。」「现实中是父亲联系了教会的一位主席，主管战争事务的，这位主席又联系了部队的团长，最后争取到了3天的探亲假。」
3. 战友在初期非常排斥多斯这种不拿武器的做法。觉得他装腔作势，装上帝，你谁呀你？！所以大家都嘲笑他，排挤他，而且还拿鞋子物品砸他。至于电影里他被掀床和打得满地找牙，也是为了戏剧需要。在军营里被打成这样，是要受到严重的军规处罚的。
4. Doss 的生活并不容易。他负伤太重，肋骨和肺损坏，被认定为90%残疾。接受了将近5年半的治疗。因为战争 Doss 失去了劳动能力，后来妻子多萝西做全职护士来养家（电影中多萝西一开始就是护士）。Doss 兑换了政府给的保险，买了一个四亩地的小房子。两人生了一个儿子，平时在小房子的草坪里种植一些水果和蔬菜，但是最后为了全面维持生计，那块草坪拿来耕作用了。之后 Doss 健康允许，开始尝试做一些兼职，比如维修工，家具工等等。2006 年，Doss 辞世。
5. Doss 参军前就一直喜欢助人为乐吗？Yes. "He was always helpful to people," said his brother Harold. Desmond took after his mother, Bertha Doss, who taught him about compassion, helping others, and the importance of following Christ. His sister Audrey recalled a time when they were young and Desmond went the extra mile to help victims of an accident. 他的sister奥黛丽回忆起他一次徒步去 3 英里外的医院献血。献血这段电影里有拍出来。
6. 为什么 Doss 在持枪问题上毫不妥协？ "I knew if I ever once compromised, I was gonna be in trouble," said Desmond, "because if you can compromise once, you can compromise again." 坚持信仰不动摇。
7. Doss 参军的原因 "I felt like it was an honor to serve God and country," Desmond said. "We were fightin\' for our religious liberty and freedom."


                ',
                        'author' => 'scil（编）',
                        'origin' => '',
                        'origin_date' => '2017/07/10',
                        'show_date' => false,
                        'origin_url' => null,
                        'origin_tip' => null,
                        'editor_id' => 1,
                        'status' => 1, 'deep' => 'open',
                        'comment' => '',
                    ],
                    'places' => [
                        [
                            'name' => '钢锯岭',
                            'english_name' => 'Hacksaw Ridge',
                            'lat' => 26.2466564,
                            'lng' => 127.7312275,
                        ],
                        [
                            'name' => 'Fairview Christian Church',
                            'english_name' => 'Fairview Christian Church',
                            'lat' => 38.0685312,
                            'lng' => -82.1828882,
                            'info' => [
                                'intro' => 'Desmond Doss grew up in the Fairview Heights area of Lynchburg, Virginia alongside his older sister Audrey and younger brother Harold.',
                            ],
                        ],
                    ],
                    'quotes' => [
                        [
                            'body' => 'One more. Help me get one more.',
                            'origin' => '01:51',
                            'spoiler' => false,
                        ],
                        [
                            'body' => 'Lord, please help me get one more.',
                            'origin' => 'Doss 02:09:20',
                            'spoiler' => false,
                        ],
                        [
                            'body' => 'He said simply, "The real heros are buried over there." ',
                            'origin' => '02:09:28',
                            'spoiler' => true,
                        ],
                        [
                            'body' => 'And if I hadn\'t got anything more out of the war than that smile he gave me, I\'d have been well repaid.',
                            'origin' => 'Doss 02:10:47',
                            'spoiler' => true,
                        ],
                        [
                            'body' => '- <z-lang title="Then why can\'t you just pick up the stupid gun and wave it around? You don\'t have to use it, just meet them halfway.">你为什么就不能拿起那个破枪挥两下 不用开枪 做做样子就行</z-lang>
- I can\'t do that. 
- <z-lang title="Yes, you can. It\'s just pride.Pride and stubbornness. Don\'t confuse your will with the Lord\'s.">不 你可以 你就是拉不下脸 别偏执 别把你的意愿解读成上帝的旨意</z-lang>
- Have I been prideful? Maybe I am prideful.But I don\'t know how I\'m going to live with myself if I don\'t stay true to what I believe.',
                            'origin' => 'Hal Doss 00:53:16',
                            'spoiler' => true,
                        ],
                        [
                            'body' => 'I would say anyone is wrong to try to compromise somebody\'s conviction. I don\'t care whether it\'s army or what it is. When you own a conviction, that is not a joke. That\'s what you are.',
                            'origin' => 'Hal Doss 02:09:35',
                            'spoiler' => true,
                        ],
                    ],
                    'comments' => [

                        [
                            '_slug' => 'gang0',
                            'quoteable_type' => 'App\Video',
                            'type' => 'comment',
                            'order' => 1,
                            'body' => '打仗当然要杀人。这部电影却讲一个拒绝拿枪的美国大兵。他投入战场，只为了救人。……上战场不杀人，这怜悯同情心，比圣母还白左了，开什么国际玩笑。 这个时候，如果没有真人真事加持，《血战钢锯岭》是根本站不住脚的。结果，《血战钢锯岭》还真有人物原型。',
                            'author' => '木卫二',
                            'author_id' => null, // todo
                            'origin' => '他打赢了一场救人的战争',
                            'origin_date' => '2016-12-09',
                            'show_date' => false,
                            'origin_url' => 'https://movie.douban.com/review/8218664/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'gang1',
                            'quoteable_type' => 'App\Video',
                            'type' => 'comment',
                            'order' => 1,
                            'body' => '战争的目的是为了和平。作为战争片，Hacksaw Ridge所展现的战场上宛如地狱般的残酷气氛和以往战争片所渲染的紧张刺激感是风格迥异的。我相信这种写实的表现手法就是为了告诉我们：战场不是一个为了展现英雄主义而存在的有趣的地方，我们只是在万不得已的情况下被迫用战争手段来捍卫和平。',
                            'author' => '鼠斩车田万齐',
                            'author_id' => null, // todo
                            'origin' => '逆境下的信仰',
                            'origin_date' => '2016-11-03',
                            'show_date' => false,
                            'origin_url' => 'https://movie.douban.com/review/8155447/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'gang2',
                            'quoteable_type' => 'App\Video',
                            'type' => 'comment',
                            'order' => 1,
                            'body' => '我们总是把奖章送给死者和先烈，歌颂他们为国家和后人做出的牺牲。但我们是否曾想过，战士们其实最想要的嘉奖，是活着看到和平与胜利到来的那一天，而不是成为一具被缅怀的冰冷尸体。为国家而战和为自己而战并不矛盾，死亡在大多数情况下都是一件轻而易举的事情，相反，活着却难得多',
                            'author' => '赵未青',
                            'author_id' => null, // todo
                            'origin' => '一个非主流英雄',
                            'origin_date' => '2016-12-09',
                            'show_date' => false,
                            'origin_url' => 'https://movie.douban.com/review/8218469/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

                    ],
                    'comments_jutou' => [

                        [
                            '_slug' => 'gang3',
                            'quoteable_type' => 'App\Video',
                            'type' => 'spoiler_comment',
                            'order' => 1,
                            'body' => '父亲Thomas Doss因为战争创伤变成了一个心灵破碎的人，Desmond意识到杀戮不能解决根本性的问题，它只会加深仇恨和损害，所有卷进去的人都是受害者，无论他们是不是胜利者，正如他的父亲，在法国失去了战友，孤独地幸存下来，无法面对战后的生活，将家庭也拖入悲惨境况。也许是因为这样，Desmond才决定，他要做个救护者，而非杀戮者。Saving is better than killing, anyway.
',
                            'author' => 'Favillae',
                            'author_id' => null, // todo
                            'origin' => 'A Hero among Heroes',
                            'origin_date' => '2016-12-10',
                            'show_date' => false,
                            'origin_url' => 'https://movie.douban.com/review/8220037/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

                    ],
                    'article_script' => [
                        [
                            'slug' => 'Dallas-Buyers-Club-script',
                            'title' => '《达拉斯买家俱乐部》电影剧本',
                            'intro' => '',
                            'author' => '译/曹艺馨',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2006-11-23',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/7212630/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                    'comment_select' => [
                        [
                            'slug' => 'comments-on-Hacksaw-Ridge',
                            'title' => '《钢锯岭》评论集',
                            'intro' => '',
                            'author' => 'scil（编）',
                            'author_id' => 1,
                            'origin' => null,
                            'origin_date' => '2017/4/23',
                            'show_date' => true,
                            'origin_url' => '',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                    'reviews' => [

                        [
                            'slug' => 'real-battlefield-not-Hacksaw-Ridge',
                            'title' => '《钢锯岭》的真正战场，并不在钢锯岭……',
                            'intro' => '',
                            'author' => '方聿南',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2016-11-30',
                            'show_date' => true,
                            'origin_url' => '//movie.douban.com/review/8202847/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'wake-up-dark',
                            'title' => '你醒过来的时候眼前一片黑暗',
                            'intro' => '',
                            'author' => 'One kisses',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2016-12-09',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/8219236/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                ],
            ],
            '肖申克的救赎' => [
                'english_name' => 'The Shawshank Redemption',
                'slug' => 'The-Shawshank-Redemption',
                'other_names' => '',
                'author' => '',
                'author_id' => null,
                'time' => '1994',
                'date' => '1994-09-10',
                'intro' => '',
                '_relations' => [
                    'vol' => [
                        'title' => 'The Shawshank Redemption',
                        'column_id' => $v_col_id,
                        'no' => ++$vol_nu,
                    ],
                    'places' => [
                        [
                            'name' => '曼斯菲尔德管教所',
                            'english_name' => 'Mansfield',
                            'addr' => 'Ohio',
                            'lat' => 40.7931279,
                            'lng' => -83.1738411,
                            'oldOrPoint' => [
                                'type' => 'point',
                                'name' => '《肖申克的救赎》监狱拍摄地',
                                'url' => 'http://www.shawshanktrail.com/',
                            ],
                            'info' => [
                                'title' => '希望',
                                'intro' => '除非我对一些事情有了一定看法，我将永远得不到平静。',
                                'relation' => true,
                            ]
                        ],
                    ],
                    'quotes' => [
                        [
                            'body' => '<z-lang title="These walls are kind of funny like that.First you hate them, then you get used to them. Enough time passed, get so you depend on them. That’s institutionalizing.">监狱里的高墙实在是很有趣。刚入狱的时候，你痛恨周围的高墙；慢慢地，你习惯了生活在其中；最终你会发现自己不得不依靠它而生存。这就是体制化。</z-lang>',
                            'origin' => '00:59:47',
                            'spoiler' => false,
                        ],
                        [
                            'body' => '<z-lang title="Let me tell you something, my friend. Hope is a dangerous thing. Hope can drive a man insane. It\'s got no use on the inside.">我来告诉你，朋友，希望是一件危险的事，希望会让人疯狂，在里面这东西一点用都没有。</z-lang>',
                            'origin' => '01:12:34',
                            'spoiler' => false,
                        ],
                        [
                            'body' => '<z-lang title="Remember, Red, hope is a good thing, maybe the best of things, and no good thing ever dies.">记住，Red, 希望是美好的，也许是人间至善，而美好的事物永不消逝。</z-lang>',
                            'origin' => '02:15:46',
                            'spoiler' => true,
                        ],
                        [
                            'body' => 'Get busy living or get busy dying.',
                            'origin' => '02:16:36',
                            'spoiler' => true,
                        ],
                        [
                            'body' => '<z-lang title="It takes a strong man to save himself, and a great man to save another">强者自救，圣者救人</z-lang>',
                            'origin' => 'Rita Heyworth and Shawshank Redemption (book)',
                            'spoiler' => true,
                        ],
                        [
                            'body' => '<z-lang title="Hope is a good thing, maybe the best of things, and no good thing ever dies.">希望是美好的，也许是人间至善，而美好的事物永不消逝.</z-lang>',
                            'origin' => 'Rita Heyworth and Shawshank Redemption (book)',
                            'spoiler' => true,
                        ],
                    ],
                    'comments' => [

                        [
                            '_slug' => 'jiushu1',
                            'quoteable_type' => 'App\Video',
                            'type' => 'comment',
                            'order' => 1,
                            'body' => '人生在世，被制度化是必然的，每个人都像安迪刚入狱时那样，接受水龙头冲洗，撒灭虱粉，进入肖申克这个社会。有意思的是，那个胖子不能被制度化，哭哭啼啼，结果当晚就被牢头打挂了。这就是拒绝和排斥制度化的惩罚。 ',
                            'author' => '豆芽™',
                            'author_id' => null, // todo
                            'origin' => '救赎的就是那颗不安分的心',
                            'origin_date' => '2010-04-09',
                            'show_date' => false,
                            'origin_url' => 'https://movie.douban.com/review/3149736/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

                    ],
                    'comments_jutou' => [


                    ],
                    'comment_select' => [
                        [
                            'slug' => 'comments-on-The-Shawshank-Redemption',
                            'title' => '评论集',
                            'intro' => '',
                            'author' => 'scil（编）',
                            'author_id' => 1,
                            'origin' => null,
                            'origin_date' => '2017/4/23',
                            'show_date' => true,
                            'origin_url' => '',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                    'reviews' => [

                        [
                            'slug' => 'hope-freedom-redemption',
                            'title' => '谁对谁的救赎？',
                            'intro' => '',
                            'author' => '笛云',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2004-09-03',
                            'show_date' => true,
                            'origin_url' => 'http://www.xici.net/d22021258.htm',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'the-living-beings-in-our-society',
                            'title' => '我们这个社会的众生相',
                            'intro' => '',
                            'author' => 'WinteRisCominG',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2008-02-05',
                            'show_date' => true,
                            'origin_url' => 'http://movie.mtime.com/12231/reviews/912306.html',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'Andy-rationality-perseverance',
                            'title' => 'Andy Dufresne',
                            'intro' => '',
                            'author' => '',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2006-01-07',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/1019121/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                ],
            ],
            '达拉斯买家俱乐部' => [
                'english_name' => 'Dallas Buyers Club',
                'other_names' => '续命枭雄\药命俱乐部',
                'author' => '',
                'author_id' => null,
                'time' => '2013',
                'date' => '2013-09-07',
                'intro' => '本片根据真人真事改编，德克萨斯人 Ron Woodroof 爱好赌博、毒品和性交易，厌恶同性恋，却罹患了当时具有强烈同性恋色彩的艾滋病，他努力求生，并从中发现了走私境外药品的赚钱机会，之后甚至和社会展开了你来我往的博弈。他有生存的空间吗？他能走多远？他选择了改变自己还是改变环境，在这片自由而保守的土地上？',
                'behind' => '在1981年，美国的医生们第一次在CDC的《病状与死亡周报》上读到了美国同性恋人群中新出现的健康问题。1981年年底，美国共有270例同性恋免疫缺损症发生，大多数患者都是年轻的同性恋男子。欧洲则有36例同性恋免疫缺损症发生，一半在法国。

1982年，CDC将同性恋免疫缺损症更名为艾滋病。1984年7月，扎伊尔、欧洲、美国联合小组共同撰写了一份针对艾滋病的研究报告，发表在英国《柳叶刀》期刊上。
                
Ron Woodroof出生于1950年，之后成为一名电工。1986年，Woodroof被诊断出感染HIV病毒且将不久于人世。在得知消息后，就像电影里的剧情一样，Woodroof查阅了能找到的各种对艾滋病的报道和最新的研究报告，并且开始自己调配组合药物以延缓病情，与此同时，在医生和一位病友的帮助下，他创立了达拉斯买家俱乐部（Dallas Buyers Club），将未经FDA批准的药物卖给其他HIV携带者。

Woodroof和他的达拉斯买家俱乐部，对抗着FDA、不合理的法规和HIV病毒，1992年9月12日，Woodroof去世，那时距离他确诊已过去六年，他不但靠着自己的努力延长了生命而且帮助其他人延长了他们的生命。

达拉斯买家俱乐部成立之初，FDA睁一眼闭一眼，但随着令人担忧的药物副作用或者更准确地说是不良反应的发生和据称堪为暴力的利润，FDA开始正视达拉斯买家俱乐部并采取了干预和处罚。
 
 1992年8月9日，一个叫比尔米努塔格里奥Bill Minutaglio的专栏记者在《The Dallas Morning News》《达拉斯晨报》的生活副刊上发表了一篇长达6页的文章，题目为《购买时间：走遍全球的荣恩伍德鲁夫走私非法药品和希望的故事》。从这个报道被发表的时间开始算起，一个剧本的创作周期开始了，而这个剧本的创作者就是名不见经传的克雷格波尔顿。他深受这个故事的鼓舞，决定全心全意地创作这个剧本，他联合编剧梅丽莎沃雷克，经历采访，查找资料，撰稿，润色，更深入查找资料，再润色。。
                
                麦康纳为饰演伍德鲁夫早在半年前就开始有计划地进行节食减肥，将原本健硕的身材减重30多斤改变成干枯消瘦的造型。
3。杰瑞德.莱托直到开拍前三周半才接到参演通知，时间紧迫下，莱托不得不依靠完全断食来迅速改变外形以最大程度接近濒临生命尽头的病人形象。
4。影片成本只有550万美元，麦康纳本人参与了投资，最终在北美 收获1632万美元的票房。
5。由于成本有限，影片的拍摄周期不得不压缩在短短的25天之内，剧组时间、资金和设备上都非常拮据。

大剂量的AZT不光杀死被感染的细胞啊病毒啊什么的 还杀死了没有病的细胞 等于破坏了病人本身的免疫系统 让病情更严重
在鸡尾酒疗法发明之前毒性远远超过药用。事实上AZT只有在小剂量搭配鸡尾酒疗法的时候才有用
 电影里面应该是AZT最开始应用于临床的时候，剂量非常大，导致非常大的副作用。而后来经过多次研究后，发现了最佳剂量，成为现代艾滋病疗法的组成之一。临床新的药物使用最开始都是从零开始摸索的。[AZT到底是否有效？](https://movie.douban.com/subject/1793929/questions/5813/?from=subject_questions)
                ',
                '_relations' => [
                    'quotes' => [
                        [
                            'body' => '',
                            'origin' => 'director\'s cut  00:54',
                        ],
                    ],
                    'comments_jutou' => [

                        [
                            '_slug' => 'club1',
                            'quoteable_type' => 'App\Video',
                            'type' => 'spoiler_comment',
                            'order' => 1,
                            'body' => '',
                            'author' => '',
                            'author_id' => null, // todo
                            'origin' => '',
                            'origin_date' => '',
                            'show_date' => true,
                            'origin_url' => '',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

                    ],
                    'article_script' => [
                        [
                            'slug' => 'Dallas-Buyers-Club-script',
                            'title' => '《达拉斯买家俱乐部》电影剧本',
                            'intro' => '',
                            'author' => '译/曹艺馨',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2006-11-23',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/7212630/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                    'comment_select' => [
                        [
                            'slug' => 'comments-on-Dallas-Buyers-Club',
                            'title' => '评论集',
                            'intro' => '',
                            'author' => 'scil（编）',
                            'author_id' => 1,
                            'origin' => null,
                            'origin_date' => '2014-04-18',
                            'show_date' => true,
                            'origin_url' => '',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                    'reviews' => [

                        [
                            'slug' => 'Ron-Woodroof-Cowboy',
                            'title' => 'Cowboy',
                            'intro' => '',
                            'author' => 'Not Otaku At All',
                            'author_id' => null,
                            'origin' => null,
                            'origin_date' => '2014-07-19',
                            'show_date' => true,
                            // zhihu: https://www.zhihu.com/question/22647040/answer/28144253
                            'origin_url' => 'https://medium.com/rewind-cinema/rewind-cinema-vol-9-5b5410a2bfad',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'rebel-song',
                            'title' => '叛逆者之歌',
                            'intro' => '',
                            'author' => '图宾根木匠',
                            'author_id' => null,
                            'origin' => '',
                            'origin_date' => '2014-03-04',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/6572563/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'a-successful-example-of-civil-protests',
                            'title' => '美囶民间抗争的成功案例',
                            'intro' => '',
                            'author' => '易速利',
                            'author_id' => null,
                            'origin' => '',
                            'origin_date' => '2013-12-23',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/6473565/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'Being-towards-death',
                            'title' => '向死而生',
                            'intro' => '',
                            'author' => '天下第一郭',
                            'author_id' => null,
                            'origin' => '《东方早报》',
                            'origin_date' => '2014-03-04',
                            'show_date' => true,
                            'origin_url' => 'https://movie.douban.com/review/6572321/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

// todo
//                        艾滋病抗争史折射出公民运动的推动力 | 书评
//http://weibo.com/ttarticle/p/show?id=2309404102181123921772&sudaref=weibo.com


                    ],
                ],// end _relations
                'brothers' => [
                    '瘟疫求生指南' => [
                        'english_name' => 'How to Survive a Plague',
                        'other_names' => '',
                        'author' => '',
                        'author_id' => null,
                        'time' => '2012',
                        'date' => '2012-01-22',
                        'intro' => '',
                        '_relations' => [
                            'quotes' => [
                                [
                                    'body' => '',
                                    'origin' => 'director\'s cut  00:54',
                                ],
                            ],
                            'comments_jutou' => [

                                [
                                    '_slug' => 'club1',
                                    'quoteable_type' => 'App\Video',
                                    'type' => 'spoiler_comment',
                                    'order' => 1,
                                    'body' => '',
                                    'author' => '',
                                    'author_id' => null, // todo
                                    'origin' => '',
                                    'origin_date' => '',
                                    'show_date' => true,
                                    'origin_url' => '',
                                    'origin_tip' => null,
                                    'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                                    'comment' => '',
                                ],

                            ],
                            'article_script' => [
                                [
                                    'slug' => 'Dallas-Buyers-Club-script',
                                    'title' => '《达拉斯买家俱乐部》电影剧本',
                                    'intro' => '',
                                    'author' => '译/曹艺馨',
                                    'author_id' => null,
                                    'origin' => null,
                                    'origin_date' => '2006-11-23',
                                    'show_date' => true,
                                    'origin_url' => 'https://movie.douban.com/review/7212630/',
                                    'origin_tip' => null,
                                    'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                                    'comment' => '',
                                ],
                            ],
                            'reviews' => [

                                [
                                    'slug' => 'Ron-Woodroof-Cowboy',
                                    'title' => 'Cowboy',
                                    'intro' => '',
                                    'author' => 'Not Otaku At All',
                                    'author_id' => null,
                                    'origin' => null,
                                    'origin_date' => '2014-07-19',
                                    'show_date' => true,
                                    // zhihu: https://www.zhihu.com/question/22647040/answer/28144253
                                    'origin_url' => 'https://medium.com/rewind-cinema/rewind-cinema-vol-9-5b5410a2bfad',
                                    'origin_tip' => null,
                                    'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                                    'comment' => '',
                                ],
                            ],
                        ],
                    ],
//                    '' => [
//                        'english_name' => '',
//                        'other_names' => '',
//                        'author' => '',
//                        'author_id' => null,
//                        'time' => '',
//                        'date' => '',
//                        'intro' => '',
//                        '_relations' => [
//                            'quotes' => [
//                                [
//                                    'body' => '',
//                                    'origin' => 'director\'s cut  00:54',
//                                ],
//                            ],
//                            'comments_jutou' => [
//
//                                [
//                                    '_slug' => 'club1',
//                                    'quoteable_type' => 'App\Video',
//                    'type' => 'spoiler_comment',
//                                    'order' => 1,
//                                    'body' => '',
//                                    'author' => '',
//                                    'author_id' => null, // todo
//                                    'origin' => '',
//                                    'origin_date' => '',
//                                    'show_date' => true,
//                                    'origin_url' => '',
//                                    'origin_tip' => null,
//                                    'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                                    'comment' => '',
//                                ],
//
//                            ],
//                            'article_script' => [
//                                [
//                                    'slug' => 'Dallas-Buyers-Club-script',
//                                    'title' => '《达拉斯买家俱乐部》电影剧本',
//                                    'intro' => '',
//                                    'author' => '译/曹艺馨',
//                                    'author_id' => null,
//                                    'origin' => null,
//                                    'origin_date' => '2006-11-23',
//                                    'show_date' => true,
//                                    'origin_url' => 'https://movie.douban.com/review/7212630/',
//                                    'origin_tip' => null,
//                                    'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                                    'comment' => '',
//                                ],
//                            ],
//                            'reviews' => [
//
//                                [
//                                    'slug' => 'Ron-Woodroof-Cowboy',
//                                    'title' => 'Cowboy',
//                                    'intro' => '',
//                                    'author' => 'Not Otaku At All',
//                                    'author_id' => null,
//                                    'origin' => null,
//                                    'origin_date' => '2014-07-19',
//                                    'show_date' => true,
//                                    // zhihu: https://www.zhihu.com/question/22647040/answer/28144253
//                                    'origin_url' => 'https://medium.com/rewind-cinema/rewind-cinema-vol-9-5b5410a2bfad',
//                                    'origin_tip' => null,
//                                    'editor_id' => 1, 'status' => 1, 'deep' => 'open',
//                                    'comment' => '',
//                                ],
//                            ],
//                        ],
//                    ],
                ],

            ], // end club
        ];


        $this->addVideos($videos);
    }

    function addVideos($videos, $type = 'first', $default_vol_id = null)
    {

        $no = 0;
        foreach ($videos as $name => $video) {
            if (++$no > 1) break;

            $relations = $video['_relations'];
            unset($video['_relations']);


            if (is_null($default_vol_id) && isset($relations['vol']))
                $vol_id = DB::table('volumes')->insertGetId($relations['vol']);
            else
                $vol_id = $default_vol_id;

            if (isset($relations['image'])) {
                $imgID = DB::table('images')->insertGetId($relations['image']);
                $video['image_id'] = $imgID;
            }

            if ($relations['tip'] ?? null) {
                $relations['tip']['slug']=$video['slug'].'---tip';
                $video['tip_id'] = $this->addQuotes([$relations['tip']], $quoteable_id = 1, $quoteable_type = 'App\Video', $data = []);
            }
            if ($relations['behind'] ?? null) {
                $relations['behind']['slug']=$video['slug'].'---behind';
                $video['behind_id'] = $this->addQuotes([$relations['behind']], $quoteable_id = 1, $quoteable_type = 'App\Video', $data = []);
            }

            echo "\n\nVideo $name\n";
            $video['volume_id'] = $vol_id;
            $video['name'] = $name;
            $video['type'] = $video['type'] ?? $type;
            $vID = DB::table('videos')->insertGetId($video);


            if (isset($relations['quotes'])) {
                foreach ($relations['quotes'] as $quote) {
                    $quote['quoteable_type'] = 'App\Video';
                    $quote['quoteable_id'] = $vID;
                    DB::table('media_quotes')->insert($quote);
                }
            }

            if (isset($relations['comments'])) {
                echo PHP_EOL . 'insert short comments' . PHP_EOL;
                $this->addQuotes($relations['comments'], $vID, 'App\Video');
            }
            if (isset($relations['comments_jutou'])) {
                echo PHP_EOL . 'insert short jutou comments' . PHP_EOL;
                $this->addQuotes($relations['comments_jutou'], $vID, 'App\Video');
            }


            if (isset($relations['article_script'])) {
                echo PHP_EOL . 'insert script ' . PHP_EOL;
                $this->addArticles($relations['article_script'], 'script', $vID, 'App\Video');
            }

            echo 'insert select comments' . PHP_EOL;

            if (isset($relations['comment_select'])) {
                $this->addArticles($relations['comment_select'], 'select', $vID, 'App\Video');
            }

            if (isset($relations['reviews'])) {
                echo PHP_EOL . 'insert long comments' . PHP_EOL;
                $this->addArticles($relations['reviews'], 'review', $vID, 'App\Video');
            }


            if (isset($relations['brothers'])) {
                $this->addVideos($relations['brothers'], 'normal', $vol_id);
            }


            if (isset($relations['places'])) {
                $place_infos = $this->insertPlaces($relations['places'], 'App\Video');
                $this->insertPlaceInfos($place_infos, $vID);
            }


        }
    }

}
