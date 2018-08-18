<?php

//use Illuminate\Database\Seeder;

class TreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->freeDir = storage_path() . '/free/trees/';
        $this->sourceDir = __DIR__ . '/book_src/';
        //

        DB::table('trees')->truncate();
        DB::table('foliages')->truncate();
        DB::table('tree_contacts')->truncate();


        $law_id = MENU_ITEMS["bay/law"]['id'];
        $read_id = MENU_ITEMS["bay/read"]['id'];
        $learn_id = MENU_ITEMS["bay/learn"]['id'];
        $play_id = MENU_ITEMS["bay/play"]['id'];
        $food_id = MENU_ITEMS["bay/food"]['id'];
        $health_id = MENU_ITEMS["bay/health"]['id'];
        $other_id = MENU_ITEMS["bay/other"]['id'];

        $current_type_id = $law_id;
        $items = [
            [
                'slug' => 'xuxin-lawyer',
                'name' => '徐昕律师',
                'master' => '徐昕',
                'master_id' => null,
                'desc' => '徐昕[xīn]，法学教授，律师领域：刑事辩护、代理申诉案件等。接案条件： 1、无罪理由充分，特别冤； 2、家属救人的决心大，毫不犹豫，甚至不顾一切； 3、当事人/家属对律师绝对信任，真诚请求，且经初步考察，不属于当时是人、事后不是人的人； 4、加分条件：具有社会意义、制度变革意义、「违宪审查意义」的案件。此外，无论案件多么热点，当事人皆必须承担差旅费。',
                'body' => '- [《找关系，不请律师，不但被骗，还会失去营救时机——徐昕的接案条件》](https://weibo.com/ttarticle/p/show?id=2309404238540123819094&mod=zwenzhang)

- [北京圣运律师事务所 徐昕简历](http://www.bjsheng.cn/index.php?m=content&c=index&a=show&catid=152&id=185)

- [法官眼中的徐昕律师](https://weibo.com/1701401324/F99gHBn9k)

- [徐昕的专业著作](https://mp.weixin.qq.com/s/kwXIR3JBaJTJSZwTjKoSgQ)

- 招聘实习:[再招助理和实习生](https://weibo.com/5116580947/GbhoWg1Bc);  [对想做律师同学的告诫](https://weibo.com/p/1001603705207048563251?mod=zwenzhang)

  ',
                'editor_id' => 1,
                'menu_item_id' => $current_type_id,

                '_relations' => [
                    'contacts' => [
                        [
                            'type' => 'weibo',
                            'name' => '法律悦读',
                            'id1' => 'https://weibo.com/dushushanmei',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'weibo',
                            'name' => '刑辩大案',
                            'id1' => 'https://weibo.com/xuxinlaw',
                            'id2' => null,
                            'intro' => '',
                            'order' => 1,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'weibo',
                            'name' => '徐昕',
                            'id1' => 'https://weibo.com/poetjustice',
                            'id2' => null,
                            'intro' => '',
                            'order' => 2,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'weibo',
                            'name' => '昕静自然好',
                            'id1' => 'https://weibo.com/lawvoice',
                            'id2' => null,
                            'intro' => '',
                            'order' => 3,
                            'enabled' => false,
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => '正义联接',
                            'id1' => 'Justicelink',
                            'id2' => null,
                            'intro' => '接受案件申请，[转介适当律师](https://mp.weixin.qq.com/s/twenPlYnkZoEvK55QaP-tQ)',
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => '大案',
                            'id1' => 'mycase',
                            'id2' => null,
                            'intro' => '',
                            'enabled' => false,
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => '诗性正义',
                            'id1' => 'lawxuxin',
                            'id2' => null,
                            'intro' => '[2014.12.10](https://mp.weixin.qq.com/s/eD4PevRGLmGxHqj4QsdXIg) - 2017',
                            'enabled' => false,
                        ],
                        [
                            'type' => 'blog',
                            'name' => '徐昕的博客',
                            'id1' => 'http://blog.sina.com.cn/s/articlelist_1701401324_0_1.html',
                            'id2' => null,
                            'intro' => '',
                        ],
                        [
                            'type' => 'zhaopin',
                            'name' => '再招助理和实习生',
                            'id1' => 'https://weibo.com/5116580947/GbhoWg1Bc',
                            'id2' => null,
                            'intro' => '',
                        ],

                        [
                            'type' => 'email',
                            'buy' => true,
                            'name' => 'xuxinlaw@163.com',
                            'id1' => '',
                            'id2' => null,
                            'intro' => '请将相关资料发至邮箱，然后联系助理肖哲 电话 17801230311',
                            'order' => 0,
                            'enabled' => true,
                        ],
                    ],

                    'image' => [
                        'local' => '',
                        'url' => 'https://tvax2.sinaimg.cn/crop.0.0.1002.1002.180/00769YXwly8fpi8ttrxm4j30ru0rugrw.jpg',
                        'alter' => null,
                        'style' => null,
                        'alt' => '徐昕律师',
                    ],

                ]
            ],

        ];


        $current_type_id = $read_id;
         $items =
        array_merge($items, [
            [
                'slug' => 'meijun',
                'name' => '美君军事',
                'master' => '美君',
                'master_id' => null,
                'desc' => '美君，知识丰富，思想自由，充满洞见，对军事、近代史、战争决策有真实而深刻的理解。美君军人家庭出身，小时因为父母繁忙而泡在空军图书馆，80 年代在南苑机场目睹美军推销而来的 F16 战斗机，对军事耳濡目染，现为了照顾家中老母亲，居家写作，已撰写了一系列富有思想和启迪的经典作品。',

                'body' => ' 
> 新闻：朝鲜弃核
>
> @仟蚊：弃核了，第二个80后邓小平。改革开放
>
> @美君01: 不可能…能用钱搞定的事就不是难事，世间唯血债难消；且“鑫”不会要美帝送来的改开，它是要美帝保证它政权的安全和稳定；因为一旦改开，其民众就会逐渐明目，最后一定要反：苏联的结局，它会不会知道么？
>
> @super20216:目前我看到的各种报道或谈及此事的个人全是对🐷一片赞美。果然希特勒只是输了而已，只是因为输了。
>
> @美君01:所以，理解洒家为何研究方法论了吧？每当历史大变局，所谓“道德、情感、原则”似如粪土、一钱不值 …… 唯方法论是干货 [嘻嘻]
>
> <cite>[《韩-朝暗战》的留言和互动](https://weibo.com/5527193038/GkPW2hlUK)</cite>

> 新闻：美国情报机构相信朝鲜几乎所有的核武器设施都在继续工作 
>
> @美君01: 别怪“鑫”背信弃义，也别怪川普故意玩弄大家…要怪就怪大家自己傻，愿意被人家愚弄；6月“双胖会”前后，网上一片弃核高潮；网V们唯@valkyrie20607 、洒家…两个，坚决认为“鑫”不会弃核…当时真是再次空前孤立啊（以前还有国主、老防两票）！
> ![“鑫”不会弃核](https://wx2.sinaimg.cn/mw1024/00623xoOly1ftu9ur6q4sj30gk06a0sz.jpg)
>
> <cite>[“鑫”不会弃核](https://weibo.com/5527193038/GsDhlkuae) 2018.8.1</cite>

> 读通华族历史后，就会明白分久必合…分成许多碎块后，就会为统一而征战…从春秋到国共，可有例外？…国族文化：绝不会如美佬那样几十个州遵守一纸宪法几百年。…所以，无论怎样乱世、混战、分裂…最后一定会重归一统，重新回到统一思想、压制维新、取缔自由、封禁言论…的群体稳定状态。 
>
> @白银时代-我爱吃猪肉：统一的状态墒值很高，自然状态墒值低，为何华族总是反其道而行之，“天降伟人”？   
> @美君01：美帝各州约法后，马萨诸塞未武力进攻康涅狄格之类，互信就建立了；期间一次违约（南北战争）若违约多了（譬如打个十次八次内战）美佬互信也会被毁掉；而国族历史太古老，违约何止千百次？谁信谁啊？假设：你是王家烈，不想去统一别人，但总有蒋中正毛润之来统一你！   
> @美君01:回复@翀锅陪你来巡山:春秋战国时代吧…中央政权建立500-600年后；美帝社会目前依然有信约，是因其建政时间太短仅240多年；就像古罗马共和，前200-300年充满理想主义、英雄主义、信约精神…500-600年后也是一塌糊涂，才被蛮族所灭。//@翀锅陪你来巡山:华族是啥时把守信给扔了的
>
> @翀锅陪你来巡山:所以文明古国就是垃圾堆   
> @美君01：以本人为例，因出身军人世家，自小喜军事，先看的西人《战争论、海权论、空中国防论》路子较正；后看《孙子兵法、孙膑兵法、三十六计、三国志、资治通鉴》…看完后心灵一片黑暗…幸亏先看的西人著述，基础较正，污泥中又长出莲花…[嘻嘻]  
>
> @美君01：西人著述谈事物本质：战争是什么？战役是什么？军队是什么？海权是什么？空权是什么？…华族经典全是如何骗人？如何害人？如何突破底线？   
> @幽忧de贼：华族擅长的这套厚黑，在西人面前屡屡吃瘪，却很少人彻底反思…   
> @美君01：回复@幽忧de贼:西人建树的战争论体系，是完整-立体-可延续的科学体系，就像银行体系；而华族“兵法”集中在“诈术”一块，就像重点研究金融诈骗术…金融诈骗有时也能使银行损失掺重，但从长久历史时期全面看，是银行统治世界呢？还是金融诈骗集团统治世界？  
> @神气飞天猪：中国传统兵法，好处在于高屋建瓴，以抽象理论提纲挈领，在前工业时代不容易过时，缺点是不接地气，从抽象原则到实战，中间缺失的环节太多，没有给军人以具体落脚点。西方则相反，对于战争本质的思辨性著作出现得晚，优点是没有花拳绣腿，就事论事，老老实实讲如何让对方死，而避免让自己死。   
> @美君01：回复@神气飞天猪:西点将《孙子》列为“有益读物”，俄军总参军事学院评级很不客气：人类早期粗陋智慧结晶…只是简单谋略理念、不全面，但已是华族兵法最高境界。对战争认识、军队建设、战争经济、战略学、战役学、战术学、军事后勤、谋略学…西方军学完整系统，就像现代医学；而华族“兵法”则像军事领域的“中医”。  
> @神气飞天猪：回复@美君01:网络谣言西点军校学孙子，后来谷歌查过西点的课表，原来是有一门大概叫经典军事理论著作选读的课，孙子是著作之一，跟克劳塞维茨，若米尼，色诺芬等人的列在一起 
> @美君01：回复@神气飞天猪:还有军制学、军事法…都是西方奠基，军制学研究军队如何编制、军人衔级如何晋升；军人也是人，服役要回报的，脱了军装要回归平民社会…可见西方军事学术之全面严谨，把人作为军事学核心研究课题…《孙子》里根本没有，这也是华族王朝军队每每朽坏原因：朝廷不把俺当人，那只能贪污军饷了[摊手]
>
> <cite>[华族分久必合](//weibo.com/5527193038/GsErvnblh) 2018.8.1</cite>
<!-- {blockquote:.ins.limit-height} -->

## 部分短篇文章

[落子有声-叙利亚难民安全区初探](https://weibo.com/ttarticle/p/show?id=2309404206894066624959&mod=zwenzhang) 美军在战术层面很成功，而政治-战略层面堪称无厘头……

[迟到的《芳华》](https://weibo.com/ttarticle/p/show?id=2309404245026128407211&mod=zwenzhang) 1969珍宝岛冲突后，中苏关系骤然紧张、走到战争边缘；苏联认真研究了入侵大陆的作战方案：核打击方案是用1000枚核弹“喂给中国人”；而地面入侵方案，最小的局部入侵计划动员50万军队，占领东北；较大的是把新疆割据出去、占据东北、兵临北京。林彪下达“第一号令”，高官及其家属全都迁往南方；而战备部队开往北方：家父当时就被派往张家口北部（大家看看地图就知，正好在苏坦克集团军进攻路线的正中央）。1978十一届三中全会后（按宣传说法“春风吹遍了神州大地”）其实应者寥寥：朝廷内部还没摆平，下面听谁的？再说了，要科技没科技、要资金没资金、要市场没市场、要人才没人才…即便是卡特这样比较低能的西方政客，也并不好骗…  
@美君01:你就属于没心没肺的典型费拉…”费拉族群“大部分都像你这样：政治家决定战争，对错与否是政治之事；而士兵牺牲，换来西方利益输送，你就没占便宜吗？若无西方政治认可，哪有改开局面，你现在就算累死每月也就600元工资！而费拉不敢批评权贵，只敢侮辱死去的士兵！[弱]

《洞朗危机的战术问题》 中印冲突曝光后，网络打法天马行空，「空军制胜、核平新德里、再版偷袭珍珠港、炸平印军机场、导弹夷平城市、布雷封锁印港…」，那真实的冲突局势和决策是怎样的呢？
- [一. 三面受敌的山地武装冲突，怎么打？](https://weibo.com/ttarticle/p/show?id=2309404138832869075013&mod=zwenzhang);  
- [二. 山地作战的炮兵应用](https://weibo.com/ttarticle/p/show?id=2309404139290492828892&mod=zwenzhang); 
- [三. 冲突升级可能性及未来趋势](https://weibo.com/ttarticle/p/show?id=2309404141354929267256&mod=zwenzhang)

[《尘封往事：1945年初的苏德秘密接触…》](https://weibo.com/ttarticle/p/show?id=2309404177018286641023&mod=zwenzhang) 雅尔塔会议的结果，大出斯大林意料：美英不但在波兰问题、战后欧洲问题上全面向苏联妥协，而且在远东问题上给了斯大林意外惊喜；斯在远东的讹诈其实是试试看，并未抱死磕决心；而美-英却轻而易举出卖了民国、韩国、日本的利益…自此，斯大林才铁了心要彻底消灭纳粹。

[欲速不达-浅谈苏德战争苏军战术中的致命“左速”](https://weibo.com/ttarticle/p/show?id=2309404186781124800130&mod=zwenzhang)

[终末的尖刺…抗战期间四战区的突击营](https://weibo.com/ttarticle/p/show?id=2309404191137609991668&mod=zwenzhang) @美君01：国党思路慢、胆略小、眼光浅、执行差、手段软、面子薄…至今仍如此；其实，敢死队不一定必须高科技：1-扣部队主官之父母妻儿为质，可保部队不叛。2-缴获敌之财货为死士所有（类似英王颁发“私掠证”）。3-以三倍薪资供给吸引亡命之徒脱羸兵为死士。…事可成  

[庞会灭关氏，与关羽擒将图](https://weibo.com/ttarticle/p/show?id=2309404196803061890491&mod=zwenzhang) @美君01:曹懂政治之恶-战争之恶应受限制，不能恣意妄为，这也是曹势力做大之原因；而关羽受袭-背后皆反，看来其并非若传说般春秋仁义，杀庞德本不过头点地-碗口疤，但估计关下手极残酷，使庞会记仇四十多年。 

[Auchinleck，奥金莱克陆军元帅](https://weibo.com/ttarticle/p/show?id=2309404223428650528189&mod=zwenzhang) Auchinleck在1942年初便开始大刀阔斧进行改革，这当然得罪了很多人，为其后来被撤职埋下伏笔。这段历史告诉我们：变革总有代价。英国的君宪制，总体上是良政，在这样的体制中，不会把Auchinleck逼成林冲；所以其背负与忍耐，最终得到了回报。

## 精品长文 知识与思想的双重结晶
<a name="buy"></a>

|  |   |   |   |
| ------ | ----------- | ----- | ----- |
| 2017.6  | [卐字的野望 -- 浅议苏德战争前期纳粹德国最严重战略错误](https://weibo.com/ttarticle/p/show?id=2309404253726511626097&mod=zwenzhang)  |   德国的军事失误在哪里？为什么提前动员有希望赢得战争？ | 14.00元 | 
| 2017.8  | [太平洋战争美军岛屿登陆作战的火力支援问题](https://weibo.com/ttarticle/p/show?id=2309404143850523371466&mod=zwenzhang)  |   @lzuan1：看完了，胜利都是尸山血海堆出来的。米国的将军也有不靠谱的时候，士兵可就惨了。所以能不打仗就不要打，开战了，人就是阿猫阿狗。<br>@美君01：任何将领都一样，因为将军们的利益，与士兵们的利益是不一致的…  | 4.98元 |
| 2017.9  | [胜利大逃亡 -- 真实与虚幻的敦刻尔克](https://weibo.com/ttarticle/p/show?id=2309404150764388885460&mod=zwenzhang) |   一战时德军北上比利时进入法国，二战时，德军会故伎重演吗？  |  8.8元  |
| 2018.1  | [雅尔塔史观 & 翻案潮](https://weibo.com/ttarticle/p/show?id=2309404200858551233218&mod=zwenzhang)  |    | 5.88元 |
| 2018.3  | [静默艅艎 -- 浅析美国海军DDG-1000](https://weibo.com/ttarticle/p/show?id=2309404212703634849034&mod=zwenzhang)  |   | 7.8元 |
| 2018.2  | [巴别之塔 -- 可复用火箭&低成本航天的发展及未来](https://weibo.com/ttarticle/p/show?id=2309404218330813707429&mod=zwenzhang) |  @美君01：文章有个思想：太空开发要资本化，逐渐改变全民纳税射火箭之模式、减少财政供养比例；而投资者要从太空开发逐渐获利、并承担投资风险。…这是满漫长的过程，但也是必由之路。 <br>兲嘲只普及“科学知识”，但禁止“科学思想”…譬如，前些天看一文章，前面谈可复用火箭，在科技方面写得很不错；最后几段文风大变：硬说“CZ-9”全面超越美帝，天晓得“CZ-9”的PPT写好了没有？[笑cry]…但不这么写无法发表 [摊手] <br> 在航天工程应用领域，别人都想赚钱，而Musk在赚钱念头下总有深层危机意识，即人类级灾难，所以别人都觉的他疯了…文章谈到这点。 | 12元 |
| 2018.3  | [暗夜之蝠 -- 美未来轰炸机LRS-B（B-21）解析](https://weibo.com/ttarticle/p/show?id=2309404222856727766537&mod=zwenzhang)  | 中国对标战机的打击目标包括美军冲绳基地，美军战机要如何实现它在新形势下的使命呢？   | 4.50元 |
| 2018.4  | [洁白与蔚蓝的光辉 -- 古希腊雕塑艺术解析: 上部-解析篇）](https://weibo.com/ttarticle/p/show?id=2309404229408582943908&mod=zwenzhang) |  为什么应了解古希腊艺术呢？ 因为这是我们国族传统文化艺术中缺憾的一块，而身体，无论如何也无法回避； 将来，子女到了青春期，父母有责任对其进行美与性的教育（不能把这部分工作全推给日本AV） | 9.98元 |
|   | [洁白与蔚蓝的光辉 -- 古希腊雕塑艺术解析: 下部-赏析篇）](https://weibo.com/ttarticle/p/show?id=2309404230879269515214) |  珍贵作品之品评…若子女学美术、音乐、文学、表演、舞蹈等，建议拥有…诗画同源、异曲同工 | 6.8元 |
| 2018.5  | [血雨刀峰 -- 孟良崮战役70年](https://weibo.com/ttarticle/p/show?id=2309404239885425839830&mod=zwenzhang)  |   @美君01: 1946-1947上半年，国军在华东的进攻，占领了江苏、安徽的共军根据地；华野只剩下山东了…所以，重点当然是山东。东北腹地辽阔，但通向中原的通道狭窄；国军像明军，不擅长机动作战，7个军在近80万平方公里远不敷用；但国军善死守（这点也像明军）只要兵力足够，堵住关-宁-锦、喜峰口-冷口等进关隘口，是可以的…所以只要拿下山东，让林彪在东北关着门发展吧，反正就3000万人。张灵甫有华族上古春秋时代士人理念+剑客风度，这也埋下其悲剧性根源… |   26.96元 |
| 2018.6  | [ 韩朝暗战 -- 韩朝非正规战简述.四部曲](https://weibo.com/ttarticle/p/show?id=2309404249662021341745&mod=zwenzhang) |  | 15.88元  |
|   | [钢雨倾盆 -- M142（HIMARS）自行火箭炮](https://weibo.com/ttarticle/p/show?id=2309404255822006894942&mod=zwenzhang)  |   包含美军和大陆现代火箭炮发展史  | 9.8元  |



',
                'editor_id' => 1,
                'menu_item_id' => $current_type_id,

                '_relations' => [
                    'contacts' => [

                        [
                            'type' => 'weibo',
                            'name' => '美君01',
                            'id1' => 'https://weibo.com/5527193038',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'weibo',
                            'name' => '科学与艺术001',
                            'id1' => 'https://weibo.com/u/5948757855',
                            'id2' => null,
                            'intro' => '备用号',
                            'order' => 1,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'wechat',
                            'name' => '美利坚08',
                            'id1' => '',
                            'id2' => null,
                            'intro' => '',
                            'order' => 2,
                        ],
                        [
                            'buy' => true,
                            'type' => 'url',
                            'name' => '[美君作品选购单]',
                            'id1' => '/bay/meijun#buy',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'buy' => true,
                            'type' => 'wechat-pub',
                            'name' => '美利坚08',
                            'id1' => '',
                            'id2' => null,
                            'intro' => '包含全部长篇，除了两篇[雅尔塔史观 & 翻案潮](https://weibo.com/ttarticle/p/show?id=2309404200858551233218&mod=zwenzhang) 和 [《静默艅艎 -- 浅析美国海军DDG-1000》](https://weibo.com/ttarticle/p/show?id=2309404212703634849034&mod=zwenzhang)',
                            'order' => 1,
                        ],
                    ],

                    'image' => [
                        'local' => '',
                        'url' => 'https://tva2.sinaimg.cn/crop.37.0.297.297.180/00623xoOjw1f6d6fpm7wvj30ap08cdgx.jpg',
                        'alter' => null,
                        'style' => null,
                        'alt' => '美君',
                    ],

                ]
            ],
            [
                'slug' => 'allsagesbooks',
                'name' => '万圣书店',
                'master' => '刘苏里',
                'master_id' => null,
                'desc' => '知名的人文学术书店。「万圣」的名字来自于万圣节，但今天的意思是「一万个圣人，这一万个圣人就是万圣书架上的作者」。店内开设「醒客咖啡厅」( Thinker’s Cafe Bar )，为思想聚会交流提供了合适空间。',

                'body' => ' 
> 不止附近的教授学生喜欢光顾，连我这等游客每回去了北京也一定要去报到。你可别以为它像台湾的诚品，咖啡店里充满了精緻的摆设优雅的桌椅，空气中还有高级的乐声。不，刘太太很强调他们拒绝「小资」，一切以平实为尚。最夸张的是他们偶而还会客气请走霸座位遇遇谈情的情侣，因为「这是一个给人讨论问题交流思想的地方」。万圣到底好在什麽地方？简单地讲，就是我从来没在那里找不到自己要找的书。儘管以大陆标准而言，它的地方不大。但是很奇怪，它摆出来的书恰巧就是我想看的；而我不想看的，却一本也见不。不像好些超级书城，你略过垃圾的时间要比真正看书的时间还多。而且不只我有这种感觉，北京「圈子里」的朋友人人都有同感。要做到这点真是不容易。在万圣，任何一本书想要进门都得经过三重审核，不入流的根本上不了架。  
> <cite>[壯哉萬聖](http://www.commentshk.com/2007/05/blog-post_2544.html)</cite>              

- 店长刘苏里主持的网络学术课堂：[《刘苏里·名家大课》](https://m.igetget.com/share/course/pay/detail/4/41)


',
                'editor_id' => 1,
                'menu_item_id' => $current_type_id,

                '_relations' => [
                    'contacts' => [

                        [
                            'type' => 'weibo',
                            'name' => '万圣网购',
                            'id1' => 'https://weibo.com/wanshengwanggou',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'weibo',
                            'name' => '醒客二张',
                            'id1' => 'https://www.weibo.com/AllSagesBooks',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'buy' => true,
                            'type' => 'taobao',
                            'name' => '万圣书园',
                            'id1' => 'https://allsagesbooks.taobao.com/index.htm',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'buy' => true,
                            'type' => 'official',
                            'name' => '官网订购',
                            'id1' => 'http://www.allsagesbooks.com/guestbook/INDEX.ASP',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'buy' => true,
                            'type' => 'url',
                            'name' => '万圣书园实体店',
                            'id1' => 'http://www.allsagesbooks.com/GUANYU/lianxi.htm',
                            'id2' => null,
                            'intro' => '北京海淀区，总店在成府路',
                            'order' => 0,
                            'enabled' => true,
                        ],
                    ],

                    'image' => [
                        'local' => '',
                        'url' => 'http://ww1.sinaimg.cn/mw690/74f67c55jw1dir4osstf0j.jpg',
                        'alter' => null,
                        'style' => null,
                        'alt' => '万圣书店',
                    ],

                ]
            ],
            [
                'slug' => 'duku',
                'name' => '读库',
                'master' => '张立宪',
                'master_id' => null,
                'desc' => '双月刊杂志《读库》及各种人文、生活类图书，每一本都是精心之作，2016 年面向儿童教育的「读小库」。',

                'body' => ' 
> 在人人都想拿风投、快速发展、快阅读的创业潮中，老六的选择乍看有点反潮流。
>
> 他拒绝快速复制、拒绝风投。创立《读库》十年，他依然坚持自己编辑每一个稿子，一个字一个字地抠，抠细节、抠封面，去印厂看样。
> 
> 「应出而未出的好书太多，应出好而没有出好的好书太多。」几年前，老六与刚刚逝去的诚品书店创始人吴清友对坐，曾如此感慨。
> 
> 读库依然保持追求品质的慢节奏，一篇长文三万字，细细读完至少需要一个小时，而创作这样一篇文章，有时是半年，有时是更长的时间。
> 
> 「作为出版人，我们亏欠读者太多。」老六认同吴清友那晚的观点。创业10年，《读库》的定价10年没变，依然是每本30元。
> 
> 但这位本名张立宪的出版人并不觉得自己落伍了。「我们是最纯粹的互联网产品。」
> 
> 去中介化、与读者直接发生关系、产品富有人格魅力，作为「最纯粹的互联网产品」，《读库》做得更加有声有色。                
>
> 说起选题，老六明显两眼放光。德国司法案例，医学大神都在计划中。老六四处「混」，拜访微软研究院，找人来写「数字英雄」，在网上勾搭了谢熊猫君，请他翻译最新的人工智能著作。
>
> 他最津津乐道的是《建筑史诗》。作者是清华大学建筑学院做建筑史研究的，他列了一个庞大的计划，有24个专题，要写十年。至今，已经或即将在读库发表的，已经有十多篇。
>
> <cite>[《读库》老六：这个行业，比金钱更重要的是时间](http://news.ifeng.com/a/20170727/51511225_0.shtml) 2017</cite>

## 老六自述

- [读库的生意经 —— 在长江商学院的分享](https://weibo.com/1182417191/EaaPP4LMx)


',
                'editor_id' => 1,
                'menu_item_id' => $current_type_id,

                '_relations' => [
                    'contacts' => [

                        [
                            'type' => 'weibo',
                            'name' => '读库',
                            'id1' => 'https://weibo.com/duku6',
                            'id2' => null,
                            'intro' => '',
                            'order' => $order = 0,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => '读库',
                            'id1' => 'dukubook',
                            'id2' => null,
                            'intro' => '每月更新四次，周一推送，内容主要是关于读库旗下所有书籍的书评书迅、读库微视频，线下活动记录等，以及拦都拦不住的老六式思考人生',
                            'order' => ++$order,
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => '读小库',
                            'id1' => 'duxiaoku666',
                            'id2' => null,
                            'intro' => '儿童书籍的出版动态、单本绘本的多角度解读，此外还会分享一些优秀的教育理念和育儿心得，作者除了自己的编辑团队，还来自广大的读者和专家后援团',
                            'order' => ++$order,
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => '读库小报',
                            'id1' => 'dukuxiaobao',
                            'id2' => null,
                            'intro' => '报道读库各部门的最新动态为己任，不负责地剧透即将推出的最新图书，并负责地解答来自读者的深度疑问',
                            'order' => ++$order,
                        ],
                        [
                            'type' => 'zhihu',
                            'name' => '读库老六',
                            'id1' => 'https://www.zhihu.com/people/dk66',
                            'id2' => null,
                            'intro' => '',
                        ],
                        [
                            'buy' => true,
                            'type' => 'tmall',
                            'name' => '读库',
                            'id1' => 'https://duku.tmall.com',
                            'id2' => null,
                            'intro' => '',
                        ],
                        [
                            'buy' => true,
                            'type' => 'official',
                            'name' => '读库',
                            'id1' => 'http://www.duku.cn',
                            'id2' => null,
                            'intro' => '',
                        ],
                    ],

                    'image' => [
                        'local' => '',
                        'url' => 'http://ww2.sinaimg.cn/small/467a4127jw1es428loipij20cd0cdaa7.jpg',
                        'alter' => null,
                        'style' => null,
                        'alt' => '读库',
                    ],

                ]
            ],
        ]);
        $current_type_id = $learn_id;
         $items =
        array_merge($items, [
            [
                'slug' => 'liufangzhai',
                'name' => '刘放斋学术英语',
                'master' => '刘放斋',
                'master_id' => null,
                'desc' => '加拿大女王大学政治学毕业，2018年，我开始引介西方博雅教育，以逐页、逐段、逐句精讲的方法，阅读西方正典。课程分为收费课与公开课，分别在荔枝微课和 bilibili 更新。 ',
                'body' => '
[免费公开课](https://space.bilibili.com/289000118/#/)
  ',
                'editor_id' => 1,
                'menu_item_id' => $current_type_id,

                '_relations' => [
                    'contacts' => [

                        [
                            'type' => 'weibo',
                            'name' => '刘放斋',
                            'id1' => 'https://weibo.com/liuyizhifangzhai',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'wechat',
                            'name' => 'xuebarunbi',
                            'id1' => '',
                            'id2' => null,
                            'intro' => '',
                        ],
                        [
                            'buy' => true,
                            'type' => 'url',
                            'name' => '柏拉图《理想国》全书通读详解',
                            'id1' => 'https://www.bilibili.com/read/cv558342',
                            'id2' => null,
                            'intro' => '逐页、逐段、逐句地阅读西方正典, [试听](https://www.bilibili.com/video/av26143651)',
                        ],
                        [
                            'buy' => true,
                            'type' => 'url',
                            'name' => '赞助刘放斋开办哲学、历史和学术英语课程',
                            'id1' => 'https://afdian.net/@liufangzhai',
                            'id2' => null,
                            'intro' => '',
                        ],
                    ],

                    'image' => [
                        'local' => '',
                        'url' => 'https://tva2.sinaimg.cn/crop.0.0.1241.1241.180/60e7473bjw8f1v4909lsvj20yi0yhjvg.jpg',
                        'alter' => null,
                        'style' => null,
                        'alt' => '刘放斋',
                    ],

                ]
            ],
        ]);
        $current_type_id = $play_id;
         $items =
        array_merge($items, [
            [
                'slug' => '',
                'name' => '',
                'master' => '',
                'master_id' => null,
                'desc' => '',
                'body' => ' 
  ',
                'editor_id' => 1,
                'menu_item_id' => $current_type_id,

                '_relations' => [

                    'image' => [
                        'local' => '',
                        'url' => 'https://tvax2.sinaimg.cn/crop.0.0.1002.1002.180/00769YXwly8fpi8ttrxm4j30ru0rugrw.jpg',
                        'alter' => null,
                        'style' => null,
                        'alt' => '徐昕律师',
                    ],

                ]
            ],
        ]);


        $current_type_id = $food_id;
         $items =
        array_merge($items, [
//            [
//                'slug' => 'zhangwen-tea',
//                'name' => '章文煮茶',
//                'master' => '章文',
//                'master_id' => null,
//                'desc' => '红茶、白茶等各地名贵茶叶，兼售特色茶具。',
//                'body' => '
//  ',
//
//                'editor_id' => 1,
//                'menu_item_id' => $current_type_id,
//
//                '_relations' => [
//                    'contacts' => [
//
//                        [
//                            'type' => 'weibo',
//                            'name' => '茶煮-文章',
//                            'id1' => 'https://weibo.com/u/6329944802',
//                            'id2' => null,
//                            'intro' => '',
//                            'order' => 0,
//                            'enabled' => true,
//                        ],
//                        [
//                            'buy' => true,
//                            'type' => 'wechat-pub',
//                            'name' => '章文煮茶',
//                            'id1' => 'https://weidian.com/?userid=819323713',
//                            'id2' => null,
//                            'intro' => '',
//                        ],
//                        [
//                            'buy' => true,
//                            'type' => 'taobao',
//                            'name' => '章文煮茶茶煮文章',
//                            'id1' => 'https://shop482505958.taobao.com/index.htm',
//                            'id2' => null,
//                            'intro' => '',
//                        ],
//                    ],
//
//                    'image' => [
//                        'local' => '',
//                        'url' => 'http://wx3.sinaimg.cn/large/006UnNNUly1fsdyzx82s7j306y06y0sn.jpg',
//                        'alter' => null,
//                        'style' => null,
//                        'alt' => '章文煮茶',
//                    ],
//
//                ]
//            ],
        ]);

        $current_type_id = $health_id;
         $items =
        array_merge($items, [
            [
                'slug' => 'Yaeher',
                'name' => '怡禾健康',
                'master' => '裴洪岗',
                'master_id' => null,
                'desc' => '医疗咨询平台，平台医生的入驻和问诊有严格的操作规范，目前以母婴健康为主。',

                'body' => ' 
## 媒体报道
[《“网红”、“中医黑”、“出走的医生”…裴洪岗到底是谁？》](https://zhuanlan.zhihu.com/p/32867373)

## 创始人裴洪岗的部分科普文章

- [一个儿科医生4年写成的育儿宝典，值得每一位中国父母收藏](https://mp.weixin.qq.com/s?__biz=MzA5NzE5ODIyOQ==&mid=2651627246&idx=1&sn=9b793f86fc66415714b31f6a9d61d48c)
- [医院自制药，是宝贝药还是垃圾药？](https://weibo.com/ttarticle/p/show?id=2309404248595837677690)

',
                'editor_id' => 1,
                'menu_item_id' => $current_type_id,

                '_relations' => [
                    'contacts' => [

                        [
                            'type' => 'weibo',
                            'name' => '怡禾健康',
                            'id1' => 'https://weibo.com/u/5155446806',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'weibo',
                            'name' => '小儿外科裴医生',
                            'id1' => 'https://weibo.com/u/1829870212',
                            'id2' => null,
                            'intro' => '让父母少花钱，让孩子少受罪',
                            'order' => 0,
                            'enabled' => true,
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => 'drpei',
                            'id1' => 'drpei',
                            'id2' => null,
                            'intro' => '',
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => '怡和科普',
                            'id1' => '',
                            'id2' => null,
                            'intro' => '',
                        ],
                        [
                            'type' => 'wechat-pub',
                            'name' => '怡禾健康',
                            'id1' => 'Yaeher',
                            'id2' => null,
                            'intro' => '',
                            'order' => 0,
                            'enabled' => true,
                        ],
                    ],

                    'image' => [
                        'local' => '',
                        'url' => 'https://tvax4.sinaimg.cn/crop.113.106.1178.1178.180/005CTJdQly8fsn5zro6gcj313a13a40n.jpg',
                        'alter' => null,
                        'style' => null,
                        'alt' => '怡禾健康',
                    ],

                ]
            ],
        ]);

        $current_type_id = $other_id;
         $items =
        array_merge($items, [
            [
                'slug' => 'weixunfang',
                'name' => '微醺坊',
                'master' => '慕容雪村',
                'master_id' => null,
                'desc' => '主营 Evie 护肤品，这是一款得到很多香港明星青睐的产品。店主在大型护肤品公司工作多年，熟悉护肤原理。',
                'body' => '',
                'buy' => '淘宝：[微醺坊 香草美人](//weixunfang.taobao.com)',
                'editor_id' => 1,
                'menu_item_id' => $current_type_id,

                '_relations' => [

                    'image' => [
                        'local' => '',
                        'url' => '',
                        'alter' => null,
                        'style' => null,
                        'alt' => '',
                    ],

                ]
            ],
        ]);

        $this->addTrees($items);
    }

    function addTrees($trees)
    {
        foreach ($trees as $tree) {

            if(empty($tree['slug'])) continue;

            $relations = $tree['_relations'];
            unset($tree['_relations']);


            if (isset($relations['place'])) {
                $place_infos = $this->insertPlaces([$relations['place']], 'App\Tree');
            } elseif (isset($relations['places'])) {
                $place_infos = $this->insertPlaces($relations['places'], 'App\Tree');
            }else
                $place_infos=[];

            $image = DB::table('images')->where('url', $relations['image']['url'])->first();
            if ($image) {
                DB::table('images')->where('url', $relations['image']['url'])->update($relations['image']);
                $imageID = $image->id;
            } else {
                $imageID = DB::table('images')->insertGetId($relations['image']);
            }

            $tree['image_id'] = $imageID;


            $this->encodeBody($tree, $tree['slug'], 'body', 'md', true);

            $treeID = DB::table('trees')->insertGetId($tree);

            $this->insertPlaceInfos($place_infos, $treeID);

            foreach ($relations['contacts'] ?? [] as $contact) {
                $contact['tree_id'] = $treeID;
                DB::table('tree_contacts')->insert($contact);
            }

        }
    }
}
