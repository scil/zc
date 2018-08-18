<?php

//use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        $this->freeDir = storage_path() . '/free/books/';
        $this->sourceDir = __DIR__ . '/book_src/';

        DB::table('books')->truncate();


        $bookColID = MENU_ITEMS["book"]['id'];
        foreach (['小说'] as $tagName){
            $tag = App\Tag::firstOrCreate(
                [
                    'name' => $tagName,
                    'official'=> $bookColID,
                    ]);
//           DB::table('taggables')->insert([
//              'tag_id'=>$tag->id,
//              'taggable_type'=>'App\\Column',
//               'taggable_id'=>$bookColID,
//           ]);
        }

        $v_col_id = MENU_ITEMS["book"]['id']; //9;
        $vol_nu=0;

        $books = [
            '刀锋' => [
                'english_name' => 'The Razor\'s Edge',
                'slug' => 'The-Razor\'s-Edge',
                'other_names' => '剃刀邊緣',
                'author' => 'W. Somerset Maugham（毛姆）',
                'author_id' => null,
                'time' => '1944',
                'date' => '1944/01/01',
                'desc'=>'战场归来，拉里不上大学，也不就业，只想探求人生的终极。',
                'intro' => '拉里是一位一战飞行员，与一个爱尔兰飞行员成为好友。然而，该好友为了救拉里不幸中弹牺牲。拉里对生命感到迷惑。复员后，他不上大学，也不就业，只想探求人生的终极。为此，他前往巴黎，又从巴黎遍游世界，最后在印度找到了吠陀经哲学。自此，慢慢的了悟人生。散尽薄产，返回美囶，准备当一个出租车司机，隐身人海，以终天年。',
                '_relations' => [
                    'vol' => [
                        'title' => 'The Razor\'s Edge',
                        'column_id' => $v_col_id ,
                        'no' => ++$vol_nu,
                    ],
                    'tags'=>[
                      [ 'name'=>'小说',
                      ],
                    ],
                    'image' => [
                        'url' => 'https://img1.doubanio.com/lpic/s2411107.jpg',
                        'local' => null,
                        'alter' => null,
                        'style' => null,
                        'alt' => 'The Razor\'s Edge',
                    ],
                    'tip' =>[

                        'quoteable_type' => 'App\Book',
                        'quoteable_id' => 1,
//                        'slug' => 'The-Razor\'s-Edge-tip',
                        'body'=>'大陆的主要译者是周煦良（1905—1984）、秭佩（1925—200?），同在 1982 年首版。周煦良译本通俗，秭佩译本雅致。如扉页《奥义书》引言，周译「一把刀的刀锋很不容易越过」，秭译「剃刀锋利，越之不易」。周最知名的译法是“晃膀子”。
                        
本世纪以来，特别是 2015 年之后，出现一些新译者，但还缺少相关评介。',
                        'body_long'=>
                        '大陆的主要译者是周煦良（1905—1984）、秭佩（1925—200?）。1982 年，两人译本分别由上海译文和湖南人民出版社首版。
                
两人译本风格不同，「互不因袭，各尽其妙」（戴馏龄语）^[[秭佩的曼斯菲尔德庄园 译的如何？](https://www.douban.com/group/topic/1710857/)]。和秭译本相比，周译本通俗，有人认为很好地表现出了「毛姆的狡黠聪慧世故」，有人认为「用词做作，咬文嚼字」，他最知名的翻译是“晃膀子”。^[[你们觉得刀锋的那个翻译是不是很差劲](https://www.douban.com/group/topic/3022292/)]

## 周、秭译本的部分对比

### 扉页《奥义书》引言

英文原版
> The sharp edge of a razor is difficult to pass over; thus the wise say the path to Salvation is hard.

周煦良译：
> 一把刀的刀锋很不容易越过；  
> 因此智者说得救之道是困难的。

秭佩译（首版）：
> 剃刀锋利，越之不易；  
> 智者有云，得渡人稀。 

另：网友[水货](https://www.douban.com/people/tongbaojia/)的翻译：
> 智者有云，救赎难得；究其所因，利刃难过。
<!-- {blockquote:cite=https://book.douban.com/review/7316246/} -->

### 开头

英文原版
> I HAVE NEVER BEGUN a novel with more misgiving. If I call it a novel it is only because I don’t know what else to call it. I have little story to tell and I end neither with a death nor a marriage. Death ends all things and so is the comprehensive conclusion of a story, but marriage finishes it very properly too and the sophisticated are ill-advised to sneer at what is by convention termed a happy ending.

周煦良译：
> 我以前写小说从没有像写这一本更感到惶惑过。我叫它做小说，只是因为除了小说以外，想不出能叫它什么。故事是几乎没有可述的，结局既不是死，也不是结婚……

秭佩译（首版）：
> 我以往写小说，在动笔之时，从来没有过这么多的疑虑。我所以把这本书叫做小说，只是因为我给它起不来别的名称。我没有很多离奇的情节以飨读者，书的结局既不是饮恨而死，也不是如愿成亲……

### 第六章第六节

英文原版
> they\'re in the Oxford Book of English Verse. D\'you remember them? "They reckon ill who leave me out; When me they fly, I am the wings; I am the doubter and the doubt, And I the hymn the Brahmin sings." 

周煦良译：
> 原来在《牛津英诗选》里，你记得吗？"他们刷掉我是他们失算，他们逃避我，我就是羽翼；我是怀疑者，我也是怀疑；我是婆罗门歌唱的圣诗。"

秭佩译（首版）：
> 那首诗选在《牛津英诗集》里，你记得它吗？"忘却我者，实乃不智；值彼翱翔，我乃双翅；我原持疑，我原不信；现唱赞歌，依婆罗门。

## 其它译本

戴珩 2001；  
南陌乔 2015；  
林步昇（林步升） 2016；  
田伟华 2016.3；  
冯涛 2016.7；  
王纪卿 2016.8

翻译是一种再创作，很难做到“信、达、雅”，不妨参考网络上的英文原版。
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
                    'places'=>[

                         [
                            'name' => '云门',
                            'english_name' => 'Cloud Gate',
                            'addr' => 'Chicago',
                            'lat' =>41.8826572,
                            'lng' =>-87.6254979,
                            'oldOrPoint' => [
                                'type' => 'point',
                                'name' => '芝加哥',
                                'english_name' => 'Chicago',
                            ],
                            'info' => [
                                'title'=>'晃膀子 / loaf',
                                'intro' => '除非我对一些事情有了一定看法，我将永远得不到平静。',
                                'relation'=>true,
                            ]
                        ],
                        [
                            'name' => '多姆咖啡馆',
                            'english_name' => 'Café Le Dome',
                            'addr' => 'Paris',
                            'lat' => 48.8576469,
                            'lng' => 2.2983275,
                            'info' => [
                                'place_name' => '巴黎',
                                'title' => '上帝！',
                                'intro' => '拉里学习死语言能有什么用处？',
                                'relation'=>true,
                            ]
                        ],
                        [
                            'name' => '卢浮宫朗斯分馆',
                            'english_name' => 'Louvre Lens',
                            'addr' => 'Lens, France',
                            'lat' =>50.430714,
                            'lng' => 2.8020556,
                            'oldOrPoint' => [
                                'type' => 'point',
                                'name' => '朗斯（曾经的煤炭中心）',
                                'english_name' => 'Lens',
                            ],
                            'info' => [
                                'title' => '煤矿',
                                'intro' => '我认为从事几个月体力劳动对我有好处',
                                'relation'=>true,
                            ]
                        ],
                         [
                            'name' => '波恩大学',
                            'english_name' => 'University of Bonn',
                            'addr' => 'Bonn, Germany',
                            'lat' =>50.7267715,
                            'lng' => 7.0843287,
                            'info' => [
                                'place_name'=>'波恩',
                                'title' => '我应当生在中世纪',
                                'intro' => '恩夏姆：如果你带着疑虑祈祷，但是出于真心，你的疑虑将会消除。',
                                'relation'=>true,
                            ]
                        ],
                        [
                            'name' => '孟买象岛',
                            'english_name' => 'Elephanta',
                            'addr' => 'Mumbai, India',
                            'lat' =>18.9621218,
                            'lng' => 72.9245857,
                            'info' => [
                                'title' => '无限岂能形诸语言？',
                                'intro' => '三头神像（湿婆三面像，各自代表着毁灭神，创造神及保护神，寓创造、保存、毁灭之奥义）',
                                'relation'=>true,
                            ]
                        ],
                    ],
                    'versions' => [
                        [
                            'order' => 1,
                            'name' => '周煦良译本',
                            'slug' => 'The-Razor\'s-Edge-by-Zhou-Xuliang',
                            'intro' => '上海译文出版社，1982 年首版，此后多次再印',
                            'integrity' => '?',
                            'ebook' => true,
                            '_relations'=>[

                                'res' => [
                                    [
                                        'name' => '1982年 扫描版',
                                        'type' => 'ebook',

                                    ],
                                    [
                                        'name' => '1982年',
                                        'type' => 'ebook',

                                    ],
                                ],
                                'errata' =>[
                                    'quoteable_type' => 'App\Book',
                                    'quoteable_id' => 1,
//                                    'slug' => 'The-Razor\'s-Edge-Zhou-Xuliang-errata',
                                    'body'=>'有些地方的翻译值得商榷。如，拉里是能够完全[无所为而为]的人，原文的 disinterested 一般译为无私；拉里找到了[安身立命之道]，原文是 happiness, 翻译过度。',
                                    'body_long'=> '有些地方的翻译值得商榷。举例如下。

Part Two Chapter 4.
> 我真希望能够使你懂得精神的生活是多么令人兴奋，[经验多么丰富]（how rich in experience）。它是没有止境的，它是极端幸福的生活。。。。你是那样的欢乐，使你对世界上任何权力和荣誉都视若敝屣。 
how rich in experience这一句，是指精神生活的丰富体验，译为[经验多么丰富]很难让人理解。^[[宇宙无极 评论 刀锋](https://book.douban.com/review/3472646/)] 

Part Four Chapter 9.
> 我觉得拉里在我认识的人当中，是唯一能够完全[无所为而为]（disinterested）的人。这就使他的行动显得古怪。有些人不相信上帝，但是，他们的所作所为却完全是为了上帝之爱
disinterested 一般翻译为无私。

Part Sever Chapter 3. 作者说 Isabel 很招人爱，就是差一点，“温柔”。原文用词：Tenderness。有读者认为「理解成温柔也没错，但是就那个语境，难道说的不是善良，或者好心肠，或者软心肠么？」^[[某些坑爹的翻译](https://book.douban.com/review/7316246/)]
                                    
结尾讲到各人都各得其所
> 拉里找到了安身立命之道
原文是 "Larry happiness"，应译为幸福、快乐。
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
                            ] ,
                        ],
                        [
                            'order' => 2,
                            'name' => '秭佩译本',
                            'slug' => 'The-Razor\'s-Edge-by-Zi-Pei',
                            'intro' => '两个版本：湖南人民出版社 1982 年首版; 华东师范大学出版社 2016 新译本',
                            'integrity' => '?',
                            'ebook' => true,
                            '_relations'=>[

                                'res' => [
                                    [
                                        'name' => '1982年 扫描版',
                                        'type' => 'ebook',

                                    ],
                                    [
                                        'name' => '1982年',
                                        'type' => 'ebook',

                                    ],
                                ],
                                'errata' =>[

                                    'quoteable_type' => 'App\Book',
                                    'quoteable_id' => 1,
//                                    'slug' => 'The-Razor\'s-Edge-Zi-Pei-errata',
                                    'body'=> '对比英文版翻了两页 译得不当的乃至完全译错的居然有三处。颇震惊。（[秭佩（新译本）的错译管窥](https://www.douban.com/review/7934769/)）
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
                                'tip' =>[

                                    'quoteable_type' => 'App\Book',
                                    'quoteable_id' => 1,
//                                    'slug' => 'The-Razor\'s-Edge-Zi-Pei-tip',
                                    'body'=> '新版的序言[《刀锋上的行者》](/article/Larry-faquir-on-the-razors-edge)，剧透严重：「句句箴言，回味原作，受益良多。只是不明白为何这般实在，加之本人之前已读过本书，不然洋洋二十几页文字所透露的信息，必将抚平阅读带来的所有波澜。」',
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
                            ] ,
                        ],
                        [
                            'order' => 3,
                            'name' => '英文原版',
                            'slug' => 'The-Razor\'s-Edge-en-edition',
                            'intro' => '',
                            'integrity' => '-',
                            'ebook' => true,
                        ],
                    ],
                    'quotes' => [
                        [
                            'body' => '<z-lang title="Larry is, I think, the only person I’ve ever met who’s completely disinterested. It makes his actions seem peculiar. We’re not used to persons who do things simply for the love of God whom they don’t believe in.">我觉得拉里在我认识的人当中，是唯一完全 disinterested （无私）的人。这就使他的行动显得古怪。有些人不相信上帝，但是，他们的所作所为却完全是为了上帝之爱；这种人我们是不习惯的。</z-lang>',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第四章·九 . p215',
                        ],
                        [
                            'body' => '「<z-lang title="It’s a long, arduous road he’s starting to travel, but it may be that at the end of it he’ll find what he’s seeking.">他开始走的是一条悠长艰苦的道路，可是，他最后也许会找到他要找的东西。</z-lang>」  
「<z-lang title="What’s that?">那是什么呢？</z-lang>」  
「<z-lang title="God.">上帝。</z-lang>」  
「<z-lang title="God!">上帝！</z-lang>」<z-lang title="she cried. But it was an exclamation of incredulous surprise. Our use of the same word, but in such a different sense, had a comic effect">她叫出来。可是，她这一句是表示极端诧异的惊叹语。我们用了同一字眼，但是，意义却完全两样</z-lang>',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第二章·七. p104',
                        ],
                        [
                            'body' => '有些人对做某一件事情具有那样强烈的欲望，连自己也刹不住车，他们非做不可。为了满足内心的渴望，他们什么都可以牺牲。',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第二章·七 . p102',
                        ],
                        [
                            'body' => '<z-lang title="He is without ambition and he has no desire for fame;">他没有野心，不要名；</z-lang><z-lang title="to become anything of a public figure would be deeply distasteful to him;">他最厌恶成为知名人士；</z-lang><z-lang title="and so it may be that he is satisfied to lead his chosen life and be no more than just himself.">所以很可以安心安意地过着自己挑选的生活，我行我素，别无所求。</z-lang>他为人太谦虚了，绝不肯使自己成为别人的表率；但是，他也许会想到，一些说不上来的人会像飞蛾扑火一样被吸引到他身边来，并且逐渐和他的热烈信仰取得一致，认为**人生最大的满足只能通过精神生活来体现**，而他本人始终**抱着无我和无求的态度，走着一条通往自我完善的道路**，将会作出自己的贡献，就如同著书立说或者向广大群众发表演讲一样。  
但这些都是揣测之辞。我是个俗人，是尘世中担人；我只能对这类人中麟凤的光辉形象表示景慕，没法步他的后尘。有时候一些比较接近通常类型的人，我自命能了解他们的内心深处；对拉里，我不能。拉里已经如他自愿的那样，藏身在那片喧嚣激荡的人海中了；

                            ',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第七章·六 . p363',
                        ],
                        [
                            'body' => '我们是世界上最大的理想主义者；我只是认为我们把理想放错了地方，我认为一个人能够追求的最高理想是自我的完善。',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第六章·六. p326',
                        ],
                        [
                            'body' => '<z-lang title="how exciting the life of the spirit is and how rich in experience.">精神的生活多么令人兴奋，<s cite="//book.douban.com/review/3472646/">经验</s><ins>体验</ins>多么丰富。</z-lang><z-lang title=" It\'s illimitable. It\'s such a happy life. ">它是没有止境的。它是极端幸福的生活。</z-lang><z-lang title="There\'s only one thing like it, when you\'re up in a plane by yourself, high, high, and only infinity surrounds you. You\'re intoxicated by the boundless space.">只有一件事同它相似，那就是当你一个人坐着飞机飞到天上，越飞越高，越飞越高，只有无限的空间包围着你，你沉醉在无边无际的空间里。</z-lang><z-lang title="You feel such a sense of exhilaration that you wouldn\'t exchange it for all the power and glory in the world.">你是那样的欢乐，使你对世界上任何权力和荣誉都视若敝屣。</z-lang>
                            ',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第二章·四. p86',
                        ],
                        [
                            'body' => '「学这有什么用处？」  
「<z-lang title="The acquisition of knowledge,">求知。</z-lang>」他笑着说。  
「我觉得没多大实际用处。」  
「也许没有，另一方面，也许有。但非常有意思。你想象不到读原文的《奥德赛》是多么扣人心弦。<z-lang title="It makes you feel as if you had only to get on tiptoe and stretch out your hands to touch the stars.">你读的时候会觉得，仿佛你只要踮起脚来，把手一伸，就可以摸到天上的群星。</z-lang>」
                            ',
                            'origin' => '秭佩译 .《刀锋》 : 湖南人民出版社, 1982 : 第二章·四 . p89',
                        ],
                        [
                            'body' => '「拉里学习死语言能有什么用处？」  
「有些人对知识有种无所为而为的欲望。这不是什么下流的欲望。」  
「如果你不预备派知识的用场，知识又有什么好处。」  
「也许他就是如此。也许单单有了知识就是满足，正如艺术家能创造一件艺术品就认为满足一样。也可能知识是为了进一步追求什么的准备。」  
「他如果要的是知识，他为什么复员之后不去进大学？纳尔逊医生和妈就是这样劝他的。」  
「我在芝加哥时跟他谈过。学位对他没有用处。我觉察到他对自己要什么有他的具体想法，而且觉得在大学里得不到。你知道，在治学上有合群的狼，也有单身的狼。我认为拉里是那种除了走自己道路没有别的路好走的人。」',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第二章·七 . p103',
                        ],
                        [
                            'body' => '「回去干什么？」  
「生活。」  
「怎样生活？」  
他的回答很冷静，但是，眼睛里闪出一种好笑的神气，因为他料准我会完全意想不到。  
「不急躁，对人随和，慈悲为怀，丢掉一个我字，不近女色。」
「高标准！」我说。「那么，为什么不近女色？你还年轻；女色和吃饭一样是人这个动物最强的本能，你这样抑制它是否明智呢？」
「所幸的是对我说来，接近女色只是寻欢作乐，而不是出于生理需要。根据个人的经验，印度的那些哲人主张不近女色可以大大增强精神的力量，这话说得再确当没有了。」
                            ',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第六章·八 . p325',
                        ],
                        [
                            'body' => '「在你处理掉你那一点点财产之前，希望你慎重考虑一下。因为一旦脱手之后，就永远不会回来。说不定有一天你为了自己或者为了别人迫切需要钱用，那时你就会后悔莫及，觉得自己做了一件蠢事。」  
他回答时，眼睛里带有嘲笑的神气，但是，丝毫不含恶意。  
「你比我把钱更加看得重。」  
「我很重视，」我直率地回答他。「要知道，你一直有钱，而我并不如此。钱能够给我带来人世上最最宝贵的东西——不求人。一想到现在只要我愿意，我就能够骂任何人滚他妈的蛋，真是开心之至，你懂吗？」  
「可是，我并不要骂任何人滚他妈的蛋；而如果我要骂的话，也不会因为银行里没有存款就不骂。你懂吗，钱对你说来意味着自由，对我则是束缚。」
                            ',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第六章·八 . p330',
                        ],
                        [
                            'body' => '魔鬼很狡猾，他又来找基督，对他说：如果你愿意接受耻辱，鞭挞，戴上荆棘编的冠，让人家把你钉死在十字架上，你将使人类得救，因为为了朋友牺牲自己的生命，是人所能表现的最伟大的爱。基督中计了。魔鬼笑得肚子都痛了，因为他知道坏人会借了为人类赎罪的名义来干坏事。…… 我只想向你指出，自我牺牲是压倒一切的情感，连淫欲和饥饿跟它比较起来都微不足道了。它使人对自己人格作出最高评价，驱使人走向毁灭。对象是什么人，毫无关系；值得也可以，不值得也可以。没有一种酒这样令人陶醉，没有一种爱这样摧毁人，没有一种罪恶使人这样抵御不了。当他牺牲自己时，人一瞬间变得比上帝更伟大了，因为上帝是无限和万能的，他怎么能牺牲自己？他顶多只能牺牲自己唯一的儿子。
                            ',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第五章·四 . p243',
                        ],
                        [
                            'body' => '我喜欢体力劳动。不论什么时候，只要看书看不下去了，我就从事一个时候体力劳动。我觉得这样能使人精神振作起来。记得有一次，我读斯宾诺莎传，读到这位哲学家为了糊口不得不打磨镜片，作者非常愚蠢地认为这对斯宾诺莎是很大的折磨。我敢说这对他的理智活动只会有好处。别的不谈，单单使他暂时不去苦思苦想那些哲学问题，也就够了。当我冲洗车子或者修理汽化器时，我的脑子是不去想什么的，而当我把手里的活做完之后，我会有一种乐滋滋的味儿，觉得自己完成了一件事情。',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第六章·八 . p328',
                        ],
                        [
                            'body' => '「老兄，在我这样的年纪，我是经不起掉队的。我在上流社会混了快五十年了，难道我不懂得这里的道理：只要你不经常在重要场合出现，你就会被人家忘记掉。」  
我弄不懂他是否意识到自己当时作了一次多么可悲的自白。我不忍心再嘲笑艾略特了；他在我眼中成了一个极其可怜的人物。他活着就是为了社会交际；宴会和他是息息相关的；哪一家请客没有他，等于给他一次侮辱；一个人溜单是羞耻的；而现在人已经老了，他对受冷落尤其怕得要死。  
艾略特从里维埃拉的这一头到里维埃拉的那一头忙得团团转，在戛纳吃午饭，在蒙特卡洛吃晚饭，拿出全副本领来适应这一家的茶会或者那一家的鸡尾酒会；而且不管自己多么疲劳，总竭力做得和蔼可亲，谈笑风生。他的内幕新闻来得个多，敢说最近的一些丑事秽闻的细节，除掉直接有关系的人外，谁也不比他知道得更早。假如你说他这种人生无益于时，他会瞠眼望着你毫不掩饰他的骇异。他会觉得你简直愚昧无知。',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第五章·三 . p235',
                        ],
                        [
                            'body' => '布太太有她自己的崇高原则和世故。她的世故使她认定，你假如要在这个世界上混得好，你就得接受这个世界的一套，而且不去做别人明白指出的那种不牢靠的事情。她的崇高原则使她相信一个人的责任就是在一个企业里找一项工作做，靠自己的努力找机会赚上一笔钱，按照符合自己地位的生活标准养家活口，使儿子们受到适当教育，俾能在长大成人之后清清白白地生活，并在死后使自己的妻子衣食无忧。',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第二章·七 . p101',
                        ],
                        [
                            'body' => '我们的生命力是旺盛的。当时，我坐在自己的小木房子里抽着烟斗时，觉得自己比从前任何时候都更加精神。我觉得体内有种力量急于要扩展出来。要我离开世界，住进一个修道院，我决计不干；相反，我要生活在世界上，爱这世界上的一切，老实说不是为它们本身，而是为了它们里面的无限。如果在那几次的片刻陶醉中，我的确和绝对合为一体，那就如他们告诉我的，什么都不能伤害我，而当我清算了今生的前因后果之后，我就不会再回到世界上来。一想到这里，我不禁充满惶惑。我要投生，投生再投生。我愿意接受形形式式的生活，不管它是怎样忧伤痛苦；我觉得只有生生不息，一个生命接一个生命，才能满足我的企求，我的活力，我的好奇心。
                            ',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第六章·八 . p323',
                        ],
                        [
                            'body' => '也许在遥远的将来，通过更大的洞察力，人类有一天将会看出只有在自己的灵魂里面寻找安慰和鼓励。我自己以为崇拜个人化的上帝只是古代祈求残忍神抵的蛮性遗留。我相信上帝只在我心里，此外哪儿都没有。……印度的那些名目繁多的神只是些用以达到使自我与至高的我合为一体的手段。…… 我一直觉得那些宗教的创始人有种使人觉得可悲的地方，因为他们要你信仰他作为得救的条件。看上去好象他们要倚靠你们的信心才能对自己有信心。这使你联想起古代那些异教的神抵，如果没有信徒的祭祀，就会变得日益憔悴。吠坛多的不二论哲学并不要求你凭信仰去接受什么；它只要求你具有认识现实的热烈欲望；它断言你能够象感到快乐或痛苦一样有把握地感觉到上帝。而且今天印度有许多人——以我所知总有成百上千的人——自认已经做到这一点。我对于人可以通过知识达到最高现实这种想法感到非常满意。在后期，印度的圣徒有鉴于人类的软弱性，承认通过爱和通过工作也可以得到解脱，但是，他们从来不否认最高但是最艰难的途径是通过知识，因为知识的工具是人类最宝贵的能力，即他的理智。
                            ',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第六章·六. p313',
                        ],
                        [
                            'body' => '我也没法相信上帝要人恭维。…… 一个人想要靠穷巴结，而从上帝那里得到拯救，我相信上帝也会看不起他。我总认为，上帝最喜欢的崇拜者是那种按照你的知识程度尽力而为的人。
                            ',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第六章·三 . p297',
                        ],
                        [
                            'body' => '你要尝尝糖的味道，你并不要变做糖。',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第六章·六. p313',
                        ],
                        [
                            'body' => '一个做母亲的把儿女当作自己唯一的生命，只会对儿女有害处。',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第四章·六. p189',
                        ],
                        [
                            'body' => '我对女人的直觉从来就不大相信；它和她们的主观愿望太适合了',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第四章·六 . p195',
                        ],
                        [
                            'body' => '她本来住在天堂，现在天堂失去了，她住不惯平凡人的平凡世界，因此，绝望之余，一头钻进地狱。',
                            'origin' => '周煦良译 . 《刀锋》 : 上海译文出版社, 1982 : 第五章·二 . p229',
                        ],
                    ],
                    'comments' => [


                        [
                            '_slug' => 'doa_1',
                            'quoteable_type' => 'App\Book',
                            'order' => 1,
                            'body' => '一个人不论信仰什么，只要是真诚的，他的一生就是一座丰碑。',
                            'author' => '漱石',
                            'author_id' => null, // todo
                            'origin' => null,
                            'origin_date' => '2016-12-25',
                            'show_date' => true,
                            'origin_url' => 'https://www.douban.com/people/65021613/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'doa_2',
                            'quoteable_type' => 'App\Book',
                            'order' => 2,
                            'body' => ' 何谓实用、实际？对于一个追求生命意义的人来说，过一种只为自己安身立命而活的生活恰恰是最实用和最实际。',
                            'author' => '烟',
                            'author_id' => null, // todo
                            'origin' => null,
                            'origin_date' => '2013-07-24',
                            'show_date' => true,
                            'origin_url' => 'https://www.douban.com/people/zerosaberz/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

                    ],
                    'comment_select' => [
                        [
                            'slug' => 'comments-about-Lary-on-the-razors-edge',
                            'title' => '拉里：其实队友的死并没有改变拉里',
                            'intro' => '上帝用一把斧子从中劈开，男男和女女分成了男和女，灵魂也跟着劈成了两半。于是，人世间的善男信女们必须生而苦苦寻找自己的另一半。而我相信还有另外一种人，他相信还有比寻找失去的灵魂更重要的事情，那就是寻找终极真理。',
                            'author' => 'scil（编）',
                            'author_id' => 1,
                            'origin' => null,
                            'origin_date' => '2017/01/11',
                            'show_date' => true,
                            'origin_url' => null,
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'comments-about-life-on-the-razors-edge',
                            'title' => '人生：我们活着是为什么呢？',
                            'intro' => '最近也进入低谷期，以前秉持的及时行乐的思想几乎不起作用了，觉得这样的自己在世上可有可无，并没有存在的意义——除非找到真正热爱的、可以为之舍弃一切的事物，这样才能有勇气活下去',
                            'author' => 'scil（编）',
                            'author_id' => 1,
                            'origin' => null,
                            'origin_date' => '2017/01/11',
                            'show_date' => true,
                            'origin_url' => null,
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'the-razors-edge-and-me',
                            'title' => '书缘：总会遇到那么几本书能够直接击中你的内心',
                            'intro' => '每个人都会碰上一两本特别的书，不是那书特别，而是那书对那人特别，书和人有缘。至于什么书，则因人而异 。我的红宝书是《刀锋》。不过如果对主人公没有共鸣，文笔再好也是其次。',
                            'author' => 'scil（编）',
                            'author_id' => 1,
                            'origin' => null,
                            'origin_date' => '2017/01/11',
                            'show_date' => true,
                            'origin_url' => null,
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'comments-on-the-razors-edge',
                            'title' => '其它：《奥义书》是印度最经典的古老著作之一',
                            'intro' => '毛姆的作品总能激起人对知识与艺术之强烈渴望，这是他令人无法自拔地喜爱着的魅力之一。',
                            'author' => 'scil（编）',
                            'author_id' => 1,
                            'origin' => null,
                            'origin_date' => '2017/01/11',
                            'show_date' => true,
                            'origin_url' => null,
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
    ],
                    'reviews' => [

                        [
                            'slug' => 'Werther-and-Larry-out-of-the-standards',
                            'title' => '脱离标准的维特和拉里——我们都没有勇气做拉里，而我们又做不了彻底的维特',
                            'intro' => '有多少人为自己存在的意义而活着。大家不过都是随波逐流，用标准来衡量幸福。维特和拉里是偏离标准轨道的两个极端。  维特选择了死，拉里选择了寻找。但我们更爱维特不是吗？因为我们都没有勇气做拉里。而我们心中都或多或少是维特。',
                            'author' => '孑孓了一',
                            'author_id' => null, // todo
                            'origin' => null,
                            'origin_date' => '2010-07-18',
                            'show_date' => true,
                            'origin_url' => 'https://book.douban.com/review/3451922/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'What-you-unwilling-to-know-you-will-never-know',
                            'title' => '你不愿理解的，你将永远无法理解',
                            'intro' => '如果高更死后籍籍无名，那么他的选择与决定、他的热情与付出还值得人们高声称颂吗？世人口中的意义，几乎都是后世人或旁人为主人公取得的成功所找到的行为动机，称其过了有意义的一生。然而，按我的理解，追寻人生的意义，只不过是寻找一种能够心甘情愿的生活方式。',
                            'author' => '卢育涛',
                            'author_id' => null, // todo
                            'origin' => null,
                            'origin_date' => '2016-04-12',
                            'show_date' => true,
                            'origin_url' => 'https://book.douban.com/review/7850178/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            'slug' => 'Larry-faquir-on-the-razors-edge',
                            'title' => '拉里：刀锋上的行者',
                            'intro' => '拉里与思特里克兰德相似，也是一个离家出走的人、无家可归的人，一个精神的漂泊者和流浪汉。离家出走之举、无家可归之感，恰是源于寻找一个精神家园的无尽欲求和强烈渴望；在精神的世界里，漂泊即是回归，流浪即是朝圣。',
                            'author' => '郭勇健',
                            'author_id' => null, // todo
                            'origin' => null,
                            'origin_date' => '2007-7-27',
                            'show_date' => true,
                            'origin_url' => 'http://blog.sina.com.cn/s/blog_4bfd723b01000bfo.html',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                    ],
                ],// end _relations

            ], // end 刀锋
            '好妈妈胜过好老师' => [
                'english_name' =>'A Good Mum Is Better Than a Good Teacher',
                'slug'=>'A-Good-Mum-Is-Better-Than-a-Good-Teacher',
                'other_names' => null,
                'author' => '尹建莉',
                'author_id' => null,
                'time' => '2009',
                'date' => '2009/01/01',
                'intro' => '',
                '_relations' => [
                    'vol' => [
                        'title' => 'education',
                        'column_id' => $v_col_id ,
                        'no' => ++$vol_nu,
                    ],
                    'tags'=>[
                        [ 'name'=>'教育', ],
                        [ 'name'=>'心理', ]
                    ],
                    'image' => [
                        'url' => 'https://img1.doubanio.com/lpic/s3615018.jpg',
                        'local' => null,
                        'alter' => null,
                        'style' => null,
                        'alt' => '好妈妈胜过好老师',
                    ],
                    'tip' =>[

                        'quoteable_type' => 'App\Book',
                        'quoteable_id' => 1,
//                        'slug' => 'good-mom-tip',
                        'body'=> '1. 本书定位是家教书，但包含对人性的真知灼见。所有人都可从中获益。
                        
2. 书名“好妈妈”，但并非只面向妈妈，此书适合抚育孩子的所有人，包括所有家庭成员和学校教师。“胜过好老师”并非厚此薄彼，而是「很久以来，我们对学校教育寄予的期望太高太多，而家庭教育的功能及重要性却被严重低估。“好妈妈胜过好老师”与其说是颠覆，不如说是还原，它让人看到学校教育的有限性和家庭教育的重要性；看到“教育”不在宏大的口号里，而在日常生活细节中，儿童最重要的老师首先是父母」。

2. 优异口碑让本书长期畅销，也导致大量仿冒书籍出现，诸如“好爸爸胜过好老师”、“好父母胜过好老师”等等，选购须谨慎。

观念是无形的，又是具体的；它弱小到可以忽略不计，也可以宏大到排山倒海。我们正处于一个科技和思想都剧烈变化的时代，社会意识的进步，使得各行业都在呼唤一些承上启下的作品的出现，教育尤其如此。” 
一本书创造的奇迹
https://mp.weixin.qq.com/s/uGfHyuo1pwqQdlp4vofGdQ

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
                    'versions' => [
                        [
                            'order' => 1,
                            'slug'=>'A-Good-Mum-Is-Better-Than-a-Good-Teacher-v2',
                            'name' => '第二版（纪念版）',
                            'intro' => '作家出版社 2014 年 11 月',
                            'integrity' => '-',
                            'ebook' => true,
                            '_relations' => [
                                'tip' =>[

                                    'quoteable_type' => 'App\Book',
                                    'quoteable_id' => 1,
//                                    'slug' => 'good-mom-v2-tip',
                                    'body'=> '第二版主要变化：第一章增加《给孩子犯错误权》（两篇文章的合集：<a href="//mp.weixin.qq.com/s/Z6F61r8eFSd-k7Oim3YBbA">《童年需要“试误”和“不听话”》</a>、<a href="//www.360doc.com/content/16/0120/19/29942582_529372320.shtml">《你真的给孩子“自由”和“尊重”了吗？》</a> ）；第六章增加<a href="//blog.sina.com.cn/s/blog_54377c2a0100zcoi.html">《永远正确的家长最失败》</a>、<a href=" //mp.weixin.qq.com/s/NVsIkc7_pA-A1zN9vtUzKA">《开提意见会》</a>和<a href="//mp.weixin.qq.com/s/4oQDtk87jnDuO_jmWTuctw">《让孩子成长得更安全些》</a>（替代了第一版中的《上海遇骗记》），删除了《小小独行侠》（适时放手让孩子独立做事、独立出行，避免大包大揽）；共计新增 4 篇新文章，去除 2 篇文章。
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
                            ]
                        ],
                        [
                            'order' => 2,
                            'name' => '第一版',
                            'slug'=>'A-Good-Mum-Is-Better-Than-a-Good-Teacher-v1',
                            'intro' => '作家出版社 2009 年 1 月',
                            'integrity' => '-',
                            'ebook' => true,
                        ],
                    ],
                    'quotes' =>
                        [
                            [
                                'body' => '一位妈妈告诉我，她用了很多办法来激励孩子。孩子考好了带他去游乐场，买名牌运动鞋，吃西餐。可每种办法只能用一两次，然后就没效了，所以孩子的学习一直没什么起色。  
一个孩子如果为了一双旱冰鞋而去学习，他在学习上就开始变得功利了。在短时间内可能会取得好成绩，可一旦得到了这双鞋，对学习就会懈怠。庸俗奖励只能带来庸俗动机，它使孩子不能够专注于学习本身，把奖品当作目的，却把学习当作一个手段，真正的目标丢失了。',
                                'origin' => '《好妈妈胜过好老师》 : 第四章·考好了不奖励',
                            ],
                            [
                                'body' => '圆圆要睡觉时，才想起今天忘了写作业，急得哭起来。我和她爸爸早就着急了，但一直装着没注意。这时我们才做出和她一样着急的神情，说：是吗，你今天没写作业啊？  
我们说这话时，没有一点责怪。家长如果抱怨，她就会忘记自责开始对抗家长。我们语气平和而友好地对她说，宝贝不要哭了，谁都会有忘记什么事情的时候。我们现在想想怎么办吧。  
她爸爸这时不由自主地说，那就晚睡会，赶快写吧。人的天性是愿意遵从自己的思想，排斥来自他人的命令。为了形成儿童的自觉意识，应该尽量让孩子自己去思考和选择。
                            ',
                                'origin' => '《好妈妈胜过好老师》 : 第四章·“不陪”才能培养好习惯',
                            ],
                        ],
                    'comments' => [


                        [
                            '_slug' => 'haomama_qi2',
                            'quoteable_type' => 'App\Book',
                            'type' => 'top',
                            'order' => 1,
                            'body' => '这本书像哲学一样深刻，像工具书一样实用，像小说一样好看',
                            'author' => '',
                            'author_id' => null, // todo
                            'origin' => null,
                            'origin_date' => null,
                            'show_date' => true,
                            'origin_url' => 'http://product.dangdang.com/23601973.html',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

                    ],
                    'suggestion' => [


                        [
                            '_slug' => 'ma_s1',
                            'quoteable_type' => 'App\Book',
                            'type' => 'top',
                            'order' => 1,
                            'title'=>'小学生读金庸的疑虑',
                            'body' => '《“好阅读”与“坏阅读”》中说「到圆圆十周岁小学毕业时，她已读完了金庸全部的武侠小说，十四部共约三、四十本」。金庸作品携带的思想观念存在争议：  
孩子阅读金庸时，可能需要事先了解一些不同的观念。

玄幻内容会误导部分读者，特别是孩子（有孩子看《白蛇》而自杀去冥界寻仙）：「玄化甚至神化过后的医学、武术成了很多人的认知世界的第一手珍贵资料，甚至是惟一的资料。许多人对医学和武术的认识，就停留在这里」（《[小时候读金庸，觉得他不获诺奖简直不公平](http://weibo.com/2399301482/F0UG33W4C)》）

以上争议并非否认金庸作品的精彩笔触和侠义精神，知名微信公众号<z-wechat data-id="dujinyong6">六神磊磊读金庸</z-wechat>对金著的深刻、老练也有生动展现。

                            
',
                            'author' => 'hanchch',
                            'author_id' => null, // todo
                            'origin' => null,
                            'origin_date' => '2011-04-10',
                            'show_date' => true,
                            'origin_url' => 'https://book.douban.com/review/4902223/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],
                        [
                            '_slug' => 'ma_s1',
                            'quoteable_type' => 'App\Book',
                            'type' => 'top',
                            'order' => 1,
                            'title'=>'',
                            'body' => '
中国农村留守儿童超过6100万，超过900万的孩子一年都见不到父母。
3年首次见妈妈 留守女童追跑1公里累瘫

被留守乡村的女同学，被托管的生活，被伤害的童年，我们一定要更努力。『丧心病狂！广西平南多名女童长期遭托管所男老师猥亵_手机新浪网』O平南多名女童长期遭老师猥亵 ​​​​ 

同意，只防不治是没有用的 
每当曝出儿童性侵案，就有很多评论呼吁重视... 来自李南心 - 微博
http://weibo.com/5415209465/Fh7jyivu8?ref=home&rid=6_0_8_2676203871938068825&type=comment
Tue Aug 15 2017 00:44:52 GMT+0800

【中国儿童遭性侵现状调查报告：3年间最少上千人被侵害】2013至2015三年间，据不完全统计，全国各地被媒体曝光的性侵儿童案共968起，受害儿童超过1790人，这只是公开报道部分，冰山一角。据人大教授估算，针对中小学生的性侵案，其隐案（未报案）比例是1：7
http://weibo.com/1642088277/DygKCcK2V
                            
',
                            'author' => 'hanchch',
                            'author_id' => null, // todo
                            'origin' => null,
                            'origin_date' => '2011-04-10',
                            'show_date' => true,
                            'origin_url' => 'https://book.douban.com/review/4902223/',
                            'origin_tip' => null,
                            'editor_id' => 1, 'status' => 1, 'deep' => 'open',
                            'comment' => '',
                        ],

                    ],
                    'reviews' => [
                    ],
                ],// end _relations
            ],// 好妈妈
            '这个时代这些人' => [
                'english_name' => null,
                'other_names' => null,
                'author' => '',
                'author_id' => null,
                'time' => '1944',
                'date' => '1944/01/01',
                'intro' => '',
                '_relations' => [
                    'quotes' => [
                    ],
                    'comments' => [
                    ],
                    'reviews' => [
                        // 粉丝发来一篇在当当看到的书评，唏嘘。
//                粉丝发来一篇在当当看到的书评，唏嘘。 来自李佳佳Audrey - 微博
//http://weibo.com/1649750547/ElJSR270q?ref=home&rid=11_0_8_2598654878603480355&type=comment#_rnd1481528650019
                    ],
                ],
            ],
            '小王子' => [
                'english_name' => 'The Road Less Traveled',
                'other_names' => null,
                'author' => 'Scott Peck（M·斯科特·派克）',
                'author_id' => null,
                'time' => '1978',
                'date' => '1978/01/01',
                'intro' => '',
                '_relations' => [
                    'quotes' => [
                    ],
                    'comments' => [
                    ],
                    'article_quotes' => [
                    ],
                    'reviews' => [
                    ],
                ],
            ],//
            '少有人走的路' => [
                'english_name' => 'The Road Less Traveled',
                'other_names' => null,
                'author' => '<z-lang lang="en" title="M·斯科特·派克">Morgan Scott Peck</z-lang>（1936-2005）',
                'author_id' => null,
                'time' => '1978',
                'date' => '1978/01/01',
                'intro' => '人性不是完美的，有懒惰和恐惧的弱点，面对人生的难题和挑战，除了陷入自怨自艾的哀叹和逃避现实的恐惧，但是，还有一种少有人走的征途。作者是一位心理医生，长期的临床工作中，目睹了许多逃避现实的案例，但也目睹了有许多人，他们为争取成熟而努力奋斗。作者说，「爱，是为了促进自己和他人心智成熟，而不断拓展自我界限，实现自我完善的一种意愿。」这种爱，不仅指父母之爱，也可指一切事业之爱、人类之爱。',
                '_relations' => [
                    'quotes' => [
                    ],
                    'comments' => [
                    ],
                    'article_quotes' => [
                    ],
                    'reviews' => [
                    ],
                ],
            ],// the road less
        ];

        $no = 0;
        foreach ($books as $name => $book) {
            ++$no;
            if ($no > 1) break;

            $this->addBook($book,$name);


        }
    }

    function addBook($book,$name=null,$type='first',$order=null,$default_vol_id=null){


        $relations = $book['_relations']??[];
        unset($book['_relations']);

        if($relations['image']??null){
            $imgID = DB::table('images')->insertGetId($relations['image']);
            $book['image_id'] = $imgID;
        }
        if($relations['tip']??null){
            $relations['tip']['slug']=$book['slug'].'---tip';
            $book['tip_id']=$this->addQuotes([$relations['tip']], $quoteable_id = 1, $quoteable_type = 'App\Book', $data = []);
        }
        if($relations['errata']??null){
            $relations['errata']['slug']=$book['slug'].'---errata';
            $book['errata_id']=$this->addQuotes([$relations['errata']], $quoteable_id = 1, $quoteable_type = 'App\Book', $data = []);
        }
        if( is_null($default_vol_id) && isset($relations['vol']))
            $vol_id = DB::table('volumes')->insertGetId($relations['vol']);
        else
            $vol_id=$default_vol_id;

        echo "\n\nBook ",$name ?? $book['name'],"  \n";
        $book['version'] = $book['version'] ?? false;
        $book['order'] = $book['order'] ?? $order;
        if($name)
            $book['name']=  $name;
        $book['type'] = $book['type'] ??  $type;
        $book['volume_id'] = $vol_id;
        $bookID = DB::table('books')->insertGetId($book);

        if (isset($relations['versions'])) {
            echo 'versions'.PHP_EOL;
            foreach ($relations['versions'] as $v_no=>$version) {
                $version['version'] = true;
                $version['book_id'] = $bookID;
//                DB::table('books')->insert($version);
                $this->addBook($version,null,null,$v_no+1);
            }
        }

        if ($relations['quotes']??null) {
            echo 'insert quotes'.PHP_EOL;
            foreach ($relations['quotes'] as $quote) {
                $quote['quoteable_type'] = 'App\Book';
                $quote['quoteable_id'] = $bookID;
                preg_match('/[\x{4e00}-\x{9fa5}a-zA-Z0-9]{4}/u',substr($quote['body'],0,50),$matches);
                $this->encodeBody($quote,
                    $item['slug']?? $matches[0]??microtime(true),
                    'body', 'md', false);
                DB::table('media_quotes')->insert($quote);
            }
        }


        if ($relations['comments']??null) {
            echo 'insert short comments'.PHP_EOL;
//                foreach ($relations['comments'] as $comment) {
            $this->addQuotes($relations['comments'], $bookID, 'App\Book',['type'=>'comment']);
//                }
        }

        if ($relations['suggestion']??null) {
            echo 'insert suggestion'.PHP_EOL;
//                foreach ($relations['comments'] as $comment) {
            $this->addQuotes($relations['suggestion'], $bookID, 'App\Book',['type'=>'suggestion']);
//                }
        }




        if ($relations['comment_select']??null) {
            echo 'insert select comments'.PHP_EOL;
            $this->addArticles($relations['comment_select'],'select', $bookID, 'App\Book');
        }


        if ($relations['reviews']??null) {
            echo 'insert long comments'.PHP_EOL;
            $this->addArticles($relations['reviews'],'review', $bookID, 'App\Book');
        }

        if(isset($relations['brothers'])){
            foreach ($relations['brothers'] as $brother) {
                $this->addBook($brother,null,'normal',null,$vol_id);
            }
        }

        if ($relations['article_quotes']??null) {
            echo 'insert long quotes'.PHP_EOL;
            $this->addArticles($relations['article_quotes'],'quote', $bookID, 'App\Book');
        }

        if($relations['tags']??null){
            $this->insertTags($relations['tags'],'App\\Book',$bookID);
        }

        if ($relations['places']??null) {
            echo 'insert places'.PHP_EOL;
            $place_infos = $this->insertPlaces($relations['places'],'App\Book');
            $this->insertPlaceInfos($place_infos, $bookID);
        }
    }

}
