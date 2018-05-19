<?php


class PersonsTableSeeder extends Seeder
{

    var $placeIDs = [];
    var $places = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('places')->truncate();
        DB::table('persons')->truncate();
        DB::table('experiences')->truncate();
        DB::table('placeables')->truncate();


        $referenceIDs = json_encode(file_get_contents(__DIR__ . '/reference_ID.php'));

        $this->places = $places = [
            '北京东总布胡同' => [
                'name' => '东总布胡同',
                'addr' => '北京',
                'address' => '北京东城区',
                'lat' => 39.912154,
                'lng' => 116.4286409,
            ],
            '芳古园' => [
                'name' => '芳古园',
                'addr' => '北京',
                'address' => '北京丰台区芳古园（南二环）',
                'lat' => 39.8677667,
                'lng' => 116.42237,
            ],
            '中国社会科学院美国研究所' => [
                'name' => '中国社会科学院美国研究所',
                'addr' => '北京',
                'address' => '北京东城区张自忠路3号美国研究所',
                'lat' => 39.906121,
                'lng' => 116.4135333,
            ],
            '中国国际问题研究院' => [
                'name' => '中国国际问题研究院',
                'addr' => '北京',
                'address' => '北京市东城区台基厂头条3号',
                'lat' => 39.906121,
                'lng' => 116.4135333,
            ],
            '河南颍河周口下游' => [
                'name' => '河南颍河周口下游',
                'addr' => '河南省周口',
                'address' => '',
                'lat' => 33.3045733,
                'lng' => 115.2436047
            ],

            'Vienna' => [
                'name' => '维也纳',
                'name_en' => 'Vienna',
                'addr' => 'Austria',
                'address' => '',
                'lat' => 48.2208286,
                'lng' => 16.2399756,
            ],
            '中华门' => [
                'name' => '中华门(梁思成当场痛哭失声)',
                'addr' => '北京',
                'address' => '',
                'lat' => 39.9016068,
                'lng' => 116.3990858,
            ],
            '北京'=>[
                '_place'=>'中华门',
                'point_to'=>'北京',
            ],
            '北京大学' => [
                'name' => '北京大学',
                'addr' => '北京',
                'address' => '',
                'lat' => 39.9879117,
                'lng' => 116.3060241,
            ],
            '清华' => [
                'name' => '清华大学',
                'addr' => '北京',
                'address' => '',
                'lat' => 39.9996715,
                'lng' => 116.3242552,
            ],
            '耀华' => [
                'name' => '耀华中学',
                'addr' => '天津',
                'address' => '天津和平区南京路耀华中学',
                'lat' => 39.1191008,
                'lng' => 117.1987888,
            ],
            '昭明里' => [
                'name' => '昭明里',
                'addr' => '天津',
                'address' => '天津和平区五大道成都道',
                'lat' => 39.1131403,
                'lng' => 117.2016315,
            ],
            '上海黄浦江 宁波路附近' => [
                'name' => '上海黄浦江 宁波路附近',
                'addr' => '上海',
                'address' => '',
                'lat' => 31.240178,
                'lng' => 121.493309,
                'comment' => null,
            ],
            'milk' => [
                'name' => '牛奶街', 'name_en' => 'Milk Street',
                'addr' => 'London',
                'address' => 'Cheapside, London, England',
                'lat' => 51.515283,
                'lng' => -0.093567,
                'comment' => '//www.waymarking.com/waymarks/WMP2E6_Sir_Thomas_More_Milk_Street_London_UK'
            ],
            'Anthony' => [
                'name' => '圣安多尼学校', 'name_en' => 'St.Anthony’s School (1440-1666)',
                'addr' => 'London',
                'address' => 'Threadneedle Street, London, England',
                'lat' => 51.5141076,
                'lng' => -0.0885464,
                'comment' => 'London’s original St. Anthony’s School, attended by St. Thomas More, was situated on Threadneedle Street in the City of London. Founded in 1440, it was destroyed in the Great Fire in 1666. Today’s school was founded by Richard Patton during the Victorian period and is now managed by the Alpha Plus Group. It moved to its Hampstead location after World War Two.'
            ],
            'Knole_House' => [
                'name' => '', 'name_en' => 'Knole House',
                'addr' => 'Kent, England',
                'address' => 'Sevenoaks, Kent, England',
                'lat' => 51.2661905,
                'lng' => 0.2046482,
            ],
            'Oxford' => [
                'name' => '牛津大学', 'name_en' => 'University of Oxford',
                'addr' => '',
                'address' => 'Sevenoaks, Kent, England',
                'lat' => 51.7566341,
                'lng' => -1.2568924,
            ],
            'middle' => [
                'name' => '', 'name_en' => 'The Middle Temple',
                'addr' => 'London',
                'address' => '',
                'lat' => 51.511699,
                'lng' => -0.1130257,
            ],
            'lincoln' => [
                'name' => '林肯律师学院', 'name_en' => 'Lincoln’s Inn',
                'addr' => 'London',
                'address' => '',
                'lat' => 51.5164125,
                'lng' => -0.1147922,

            ],
            'London Charterhouse' => [
                'name' => '伦敦卡尔特修道院', 'name_en' => 'London Charterhouse (1370–1538)',
                'addr' => 'London',
                'address' => 'Smithfield, London',
                'lat' => 51.5209453,
                'lng' => -0.1005689,

            ],
            'Guildhall' => [
                'name' => '伦敦市政厅', 'name_en' => 'Guildhall, London',
                'addr' => '',
                'address' => 'The ceremonial heart of London\'s administration with an art museum, public library and clock museum',
                'lat' => 51.515819,
                'lng' => -0.091982,
            ],
            'Ostend' => [
                'name' => '奥斯坦德', 'name_en' => 'Ostend',
                'addr' => 'Belgian',
                'address' => 'Ostend is a Belgian coasted city and municipality, located in the province of West-Flanders',
                'lat' => 51.214119,
                'lng' => 2.8517549,

            ],
            'Beaufort' => [
                'name' => '', 'name_en' => 'Beaufort House',
                'addr' => 'Chelsea, England',
                'address' => 'Chelsea, England',
                'lat' => 51.4861215,
                'lng' => -0.1807993,

            ],
            'Calais' => [
                'name' => '加来', 'name_en' => 'Calais',
                'addr' => 'France',
                'address' => 'Calais is a port city in northern France.',
                'lat' => 50.9551949,
                'lng' => 1.8434207,

            ],
            'tower' => [
                'name' => '伦敦塔', 'name_en' => 'Tower of London',
                'addr' => '',
                'address' => 'a historic castle located on the north bank of the River Thames in central',
                'lat' => 51.5054947,
                'lng' => -0.0788461,

            ],
            'Bucklersbury street' => [
                'name' => '', 'name_en' => 'Bucklersbury street',
                'addr' => 'London',
                'address' => 'Bucklersbury street, London',
                'lat' => 51.5128517,
                'lng' => -0.0917373,

            ],
            'yan_shan_tinghu' => [
                'name' => '砚山听湖水库',
                'addr' => '云南',
                'lat' => 23.630388,
                'lng' => 104.362828,
            ],
            'yan_shan' => [
                'point_to' => '砚山',
                '_place' => 'yan_shan_tinghu'
            ],
//            'kun_ming' => [
//            ],
            'mingtong_xiaoxue' => [
                'name' => '昆明明通小学',
                'addr' => '',
                'lat' => 25.0400038,
                'lng' => 102.7187723
            ],
            'jingguo_xiaoxue' => [
                'name' => '昆明红旗小学靖国校区',
                'addr' => '',
                'lat' => 25.0334448,
                'lng' => 102.7005273
            ],
            'kun_ming_8_lang' => [
                'name' => '昆明八中外国语实验学校',
                'addr' => '',
                'comment' => '昆明第八中学的西坝分校，在 2003 年合并昆明二十二中并在昆二十二中原址建立的新校区',
                // baidu
                'lat' => 25.031928,
                'lng' => 102.695137,
            ],
            'kun_ming_shi_shiyan' => [
//                昆明师院附中
                'name' => '云南师范大学实验中学',
                'addr' => '昆明',
                'comment' => '昆明市建设路484号，云南师大附中的旧校址',
                'lat' => 25.0518602,
                'lng' => 102.6948985,
            ],
            'kun_ming_mile' => [
                'name' => '昆明弥勒寺社区',
                'addr' => '',
                'lat' => 25.0289778,
                'lng' => 102.6987233,
            ],
            'ke_da' => [
                'name' => '中国科学技术大学',
                'addr' => '安徽',
                'lat' => 31.8380338,
                'lng' => 117.256715
            ],
            'guo_ke_da' => [
//科大北京研究生院
                'name' => '中国科学院大学',
                'addr' => '北京',
                'lat' => 39.9141471,
                'lng' => 116.2504113
            ],
            'Hopkins' => [
                'name' => '约翰斯·霍普金斯大学', 'name_en' => 'Johns Hopkins University',
                'addr' => 'Baltimore, MD',
                'lat' => 39.3299054,
                'lng' => -76.6227064
            ],
            'Druid Lake' => [
                'name' => '', 'name_en' => 'Druid Lake',
                'addr' => 'Baltimore, MD',
                'lat' => 39.318317,
                'lng' => -76.637604
            ],
            'Imagine' => [
                'name' => '想象软件公司', 'name_en' => 'Imagine Software, Inc.',
                'addr' => 'New York',
                'address' => '22 Cortlandt St., New York, NY ',
                'lat' => 40.7105135,
                'lng' => -74.0127689
            ],
            'John' => [
                'name' => '', 'name_en' => 'John Jay College of Criminal Justice',
                'addr' => 'New York',
                'address' => '524 W 59th St, New York, NY 10019',
                'lat' => 40.7703971,
                'lng' => -73.9906882,
            ],
            'New York Bay' => [
                'name' => '', 'name_en' => 'New York Bay',
                'addr' => '',
                'lat' => 40.6243,
                'lng' => -74.0590124,
            ],

        ];

        $places = array_merge($places, [

            'Brooklyn' => [
                'name' => '布鲁克林',
                'name_en' => 'Brooklyn',
                'addr' => '',
                'address' => 'Brooklyn, New York City',
                'lat' => 40.6454199,
                'lng' => -74.0850825,
            ],
            'Far_Rockaway' => [
                'name' => '',
                'name_en' => 'Far Rockaway',
                'addr' => '',
                'address' => 'Queens, New York City',
                'lat' => 40.6021936,
                'lng' => -73.7682346,
            ],
            'Far_Rockaway_High_School' => [
                'name' => '',
                'name_en' => 'Far Rockaway High School',
                'addr' => 'New York City',
                'address' => '8-21 Bay 25 Street in Far Rockaway, Queens, New York City',
                'lat' => 40.602351,
                'lng' => -73.76537,
            ],
            'MIT' => [
                'name' => '麻省理工学院',
                'name_en' => 'Massachusetts Institute of Technology',
                'addr' => '',
                'address' => '',
                'lat' => 42.3600949,
                'lng' => -71.0963487,
            ],
            '普林斯顿大学' => [
                'name' => '普林斯顿大学',
                'name_en' => 'Princeton University',
                'addr' => '',
                'address' => '',
                'lat' => 40.3439929,
                'lng' => -74.6536368,
            ],
            'Los_Alamos' => [
                'name' => '洛斯阿拉莫斯',
                'name_en' => 'Los Alamos',
                'addr' => '',
                'address' => '',
                'lat' => 35.891987,
                'lng' => -106.3250606,
            ],
            'Cornell' => [
                'name' => '',
                'name_en' => 'Cornell University',
                'addr' => '',
                'address' => '',
                'lat' => 42.4534531,
                'lng' => -76.4756914,
            ],
            '加州理工学院' => [
                'name' => '加州理工学院',
                'name_en' => 'California Institute of Technology',
                'addr' => '',
                'address' => '',
                'lat' => 34.137662,
                'lng' => -118.1274577,
            ],
        ]);

        foreach ($places as $name => $place) {
            if( ($place['old_name']??null) || ($place['point_to']??null)  ){
                $new_place_id = $this->insertPointOrOldPlace($place,$place['_place']);
                $this->placeIDs[$name] = $new_place_id;
            }else
                $this->placeIDs[$name] = DB::table('places')->insertGetId($place);
        }
        $placeIDs = $this->placeIDs;


        $suggestRefs = [

            'map' => [
                'title' => '通过地图展示 More 在英格兰和其它地方的活动',
                'intro' => null,

                'author' => '',
                'url' => '//www.thomasmorestudies.org/map.html',

            ],
            'his' => [
                'date' => '2014-03-19',
                'url' => '//www.historyofparliamentonline.org/volume/1509-1558/member/more-thomas-i-147778-1535#footnote1_ztj79sy',
            ],
        ];

        $refs = [
            'Zi' => [
                'ming_yuan' => [
                    'url' => '//finance.ifeng.com/news/people/20121031/7236201.shtml',
                ],
                'zhan_hou' => [
                    'title' => '《战后美国外交史》',
                    'url' => '//book.douban.com/subject/3723406',
                ],
                'zongpu' => [
                    'title' => '高山流水半世谊——宗璞与我',
                    'url' => 'weixin.sogou.com/weixin?type=2&query=Zi-Zhongyun+高山流水半世谊——宗璞与我',
                    'origin' => '2005年首发于《钟山》杂志，收入《闲情记美》',
                    'date' => '2005/01/01',
                ],
                'father' => [
                    'title' => '沉默的银行家父亲',
                    'url' => 'http://news.sina.com.cn/c/2009-09-09/101318613073.shtml',
                    'date' => '2009-09-09',
                ],
                'chen' => [
                    'title' => '陈乐民 资中筠：美国与欧洲文明一脉相承',
                    'origin' => '《访问历史》',
                    'url' => 'http://www.newsmth.net/nForum/#!article/Alumni/9037',
                    'date' => '2007/09/01',
                ],
                'ji_huang' => [
                    'title' => '记饿——“大跃进”余波亲历记',
                    'origin' => '《书屋》 2008 年第 1 期',
                    'url' => 'http://news.ifeng.com/history/zhongguoxiandaishi/detail_2012_04/02/13622218_0.shtml?_from_ralated',
                    'date' => '2008/01/01',
                ],
                'li_cheng' => [
                    'title' => '资中筠的思想历程',
                    'url' => 'http://read.jd.com/15720/757856.html',
                    'origin' => '《中国在历史的转折点》访谈',
                    'date' => '2010/06/17',
                ],
                'dao_tong0' => [
                    'title' => '重建对“道统”的担当',
                    'url' => '//read.jd.com/15720/757848.html',
                    'origin' => '《中国在历史的转折点》访谈',
                    'date' => '2010/06/17',
                ],
                'dao_tong' => [
                    'unuseful' => true,
                    'title' => '资中筠：重建知识分子对“道统”的担当',
                    'url' => 'http://www.eeo.com.cn/eeo/jjgcb/2010/07/05/174485.shtml',
                    'origin' => '经济观察报 内容全部来自《中国在历史的转折点》</a>',
                    'date' => '2010/07/02',
                ],
                'nanfang' => [
                    'title' => '资中筠：斗室中的天下',
                    'origin' => '《南方人物周刊》 2010年37期',
                    'url' => 'http://news.ifeng.com/history/zhongguoxiandaishi/detail_2010_10/29/2943140_0.shtml',
                    'date' => '2010-10-25',
                ],
                'lvli' => [
                    'title' => '关于我的履历',
                    'origin' => '《资中筠自选集：士人风骨》',
                    'url' => 'http://www.360doc.com/content/11/1111/21/2357411_163657966.shtml',
                    'date' => '2011-10-01',
                ],
                '不尽之恩' => [
                    'title' => '《资中筠自选集：不尽之思》',
                    'origin' => '',
                    'date' => '2011-10-01',
                ],
                'suzhi' => [
                    'title' => '何谓素质教育？——回忆母校天津耀华学校',
                    'origin' => '《资中筠自选集：不尽之思》',
                    'url' => 'http://blog.sina.com.cn/s/blog_498313d80102v53q.html',
                    'date' => '2011-10-01',
                ],

                'chang_shi' => [
                    '_referenceable_type' => [
                        'Article' => ['order' => 1, 'type' => 'suggest',],
                        'Person',
                    ],
                    'title' => '回归常识——访资中筠先生',
                    'intro' => '我一个同事出国工作了 8 个月，回来以后发现在“官方宣传”中张良怎么变成正面人物了，那时候又肯定张良了。因为张良是辅佐汉高祖的，被认为是“法家”，那位同事问我，怎么张良又变好人了?我说你出国那 8 个月里头，他可能改造好了。事情已经荒唐到这个程度了。…… 我悲观，我没看到有效的推动力量和途径。…… 假如为了守住底线而需要牺牲掉一些现在的利益的话，也应该有所准备。',
                    'origin' => '2011 年 11 月五家媒体联合采访',
                    'url' => '//www.21ccom.net/articles/shishuo/20141028115382_all.html',
                    'date' => '2011/11/01',
                ],
                'shang_jiao' => [
                    'title' => '不要上缴独立思考的权利',
                    'origin' => '环球人物 2011 年第 31 期',
                    'url' => '//paper.people.com.cn/hqrw/html/2011-11/26/content_966659.htm',
                    'date' => '2011/11/01',
                ],
                'xin_yi' => [
                    'title' => '资中筠的信与疑',
                    'origin' => '南都周刊2011年度第46期',
                    'url' => '//www.nbweekly.com/news/people/201111/28298.aspx',
                    'date' => '2011/11/01',
                ],
                'mi_xin' => [
                    'title' => '一代知识分子如何从独立到迷信再到反思',
                    'origin' => '北京晨报',
                    'url' => 'http://www.360doc.com/content/13/0202/20/5316345_263810378.shtml',
                    'date' => '2011/11/05',
                ],

                'shi_zi' => [
                    'title' => '资中筠：投入水中的一枚石子',
                    'url' => 'http://news.ifeng.com/shendu/zgxwzk/detail_2014_01/17/33123943_0.shtml',
                    'date' => '2014-01-17',
                ],
                'sohu' => [
                    'title' => '先生曾经这样上学”——资中筠和她的校园',
                    'url' => 'http://learning.sohu.com/s2014/zizhongyun/',
                    'date' => '2014/04/20',
                ],
                // todo 是否把链接改为本站转载的文章的地址
                'new_jing' => [
                    'title' => '资中筠：最值得珍惜的是“独立人格”',
                    'url' => 'http://www.bjnews.com.cn/news/2015/11/11/383841.html',
                    'date' => '2015/11/11',
                ],
                'caifu' => [
                    'title' => '资中筠 公益的目的不是养懒汉',
                    'url' => 'http://www.bjnews.com.cn/news/2015/11/11/383841.html',
                    'date' => '2016/01/12',
                ],
                'caifu_xu' => [
                    'title' => '《财富的责任与资本主义演变》第四版（序）',
                    'url' => 'http://oicwx.com/detail/632009',
                    'date' => '2015/08/01',
                ],
                'caifu_zishu' => [
                    'title' => '资中筠:《财富的责任与资本主义演变》自述',
                    'url' => 'http://mp.weixin.qq.com/s?__biz=MzAwOTY5MDQzNg==&mid=211133703&idx=1&sn=6011a87f4aaab598606bc6664becdeff&scene=4',
                    'date' => '2015/09/07',
                ],
                'zhong_wen' => [
                    'title' => '资中筠：我们为什么要学好中文？',
                    'url' => 'http://learning.sohu.com/20160112/n434212187.shtml',
                    'date' => '2016-01-12',
                ],
            ],

            'Thomas_More' => [

                'more-zhexue' => [
                    'title' => ' 西方哲学史',
                    'intro' => null,

                    'author' => '罗素',
                    'date' => null,
                    'url' => 'http://www.phil.pku.edu.cn/res/files/russell/wphihischs/053.htm',
                ],
                'more-map' => [
                    'url' => '//www.thomasmorestudies.org/sitemap.html',
                ],
                // 此资料较其它详细、完整
                'his' => [
                    'date' => '2014-03-19',
                    'url' => '//www.historyofparliamentonline.org/volume/1509-1558/member/more-thomas-i-147778-1535#footnote1_ztj79sy',
                ],
//                 todo: 未充分吸收
                'more-edu' => [
                    'date' => '2014-03-19',
                    'url' => '//plato.stanford.edu/entries/thomas-more',
                ],
//                 todo: 未充分吸收
                'ewtn' => [
                    'url' => '//www.ewtn.com/library/MARY/THOMASMO.HTM',
                ],
                'faithful' => [
                    'url' => '//www.crisismagazine.com/2012/saint-thomas-more-1478-1535',
                ],
                'more-list' => [
                    'url' => '//www.luminarium.org/renlit/morebio.htm',
                ],
                'wiki-more' => [
                    'url' => '//en.wikipedia.org/wiki/Thomas_More',
                ],
                'lincoln' => [
                    'url' => '//www.lincolnsinn.org.uk/images/word/Library/thomasmorechronologyrev1.pdf',
                ],
                'Par' => [
                    'url' => '//en.wikipedia.org/wiki/City_of_London_%28elections_to_the_Parliament_of_England%29#Parliaments_of_King_Henry_VIII_of_England',
                ],
                'Wolsey' => [
                    'url' => '//en.wikipedia.org/wiki/Thomas_Wolsey#Failures_with_the_Church',
                ],
                'Evil_May' => [
                    'url' => '//en.wikipedia.org/wiki/Evil_May_Day',
                ],
                'Pico' => [
                    'url' => '//www.jstor.org/stable/2857101?seq=1#page_scan_tab_contents'
                ],
                'mag' => [
                    'url' => '//www.spartacus-educational.com/Margaret_Roper.htm'
                ],
                'stmomaha' => ['url' => '//www.stmomaha.org/St--Thomas-More'],
                'guildhall' => ['url' => '//www.thomasmorestudies.org/map-lon-5.html'],
                'more-gov' => [
                    'url' => '//www.rbkc.gov.uk/vmhistory/general/vm_hs_p02.asp',
                ],
                'more-st' => [
                    'url' => '//www.sloanestreet.co.uk/en/lifestylearticles/sloane-street-insider/fact-of-the-week-sir-thomas-more-chelsea-s-saint'
                ],
                'wiki-father' => [
                    'url' => '//en.wikipedia.org/wiki/John_More_(judge)',
                ],
                'google-ebook-source' => [
                    'title' => 'A Thomas More Source Book',
                    'intro' => null,

                    'author' => 'Cresacre More',
                    'date' => '2004-01-01',
                    'url' => '//books.google.co.jp/books?id=AQtmzR9TXncC',

                ],
                'google-ebook' => [
                    'title' => 'The Life of Sir Thomas More ',
                    'intro' => null,

                    'author' => 'Cresacre More',
                    'date' => '2005-01-20',
                    'url' => '//books.google.co.jp/books?id=OYZmAAAAMAAJ',

                ],
                'google-ebook-a' => [
                    'title' => 'Thomas More: A Biography',
                    'intro' => null,

                    'author' => 'Richard Marius',
                    'date' => '1999-01-01',
                    'url' => '//books.google.com/books?id=DdAYSzj20t0C',

                ],
            ],
            'Huang_Yu' => [
                'lishangjing' => [
                    '_referenceable_type' => [
                        'Person',
                    ],

                    'title' => '送别黄渝',
                    'intro' => null,
                    'author' => '李尚靖(中国科技大学数学系 81 级)',
                    'date' => '2004-12-29',
                    'url' => 'http://www.mitbbs.com/article_t/USTC/1186975.html',

                ],
                'father' => [
                    '_referenceable_type' => [
//                            'Article' => ['order' => 1, 'type' => 'suggest',],
                        'Person',
                    ],

                    'title' => '思念黄渝',
                    'intro' => null,
                    'author' => '黄兆元（黄的爸爸）',
                    'date' => '2005-03-26',
                    'url' => '//groups.yahoo.com/neo/groups/ourfriendhuangyu/conversations/topics/135',

                ],
                'zengsixin' => [
                    '_referenceable_type' => [
//                            'Article' => ['order' => 2, 'type' => 'suggest',],
                        'Person',
                    ],
                    'title' => '怀念黄渝',
                    'intro' => '',
                    'author' => '曾思欣（黄在 Johns Hopkins 的校友，也是搬到 New York 后常往来的好友）',
                    'date' => '2005-01-03',
                    'url' => '//bbs.creaders.net/sports/bbsviewer.php?trd_id=105426',

                ],
                'shenqiong' => [
                    '_referenceable_type' => [
//                            'Article' => ['order' => 3, 'type' => 'suggest',],
                        'Person',
                    ],

                    'title' => '魂归滇渝',
                    'intro' => '夜已深，还是没见黄渝回来，通常这时他应该拎着一冰桶的鱼，风尘仆仆的归来，意犹未尽的和我们回味他钓鱼的乐趣……一个多星期了，没有奇迹发生，我想，黄渝真的不会再回来了......',
                    'author' => '申琼（2004年初开始和黄住在同一寓所）',
                    'date' => '2005-01-07',
                    'url' => '//www2.bbsland.com/child/messages/5598.html',

                ],
                'liuyang' => [
                    '_referenceable_type' => [
                        'Person',
                    ],

                    'title' => '回忆黄渝',
                    'intro' => '他给我的第一个感觉，就是忠厚宽广。以后的交往也验证了这个印象，特别有两件小事，让我难忘。',
                    'author' => '刘阳（在纽约认识的朋友）',
                    'date' => '2005-01-01',
                    'url' => '//groups.yahoo.com/neo/groups/ourfriendhuangyu/conversations/topics/112',

                ],
                'zhuidaohui' => [
                    '_referenceable_type' => [
//                            'Article' => ['order' => 1, 'type' => 'suggest',],
                        'Person',
                    ],

                    'title' => '黄渝追悼会上的发言',
                    'intro' => null,
                    'author' => '曾思欣',
                    'date' => '2005-01-08',
                    'url' => 'http://blog.tianya.cn/blogger/post_show.asp?BlogID=98927&PostID=1040599',

                ],
                'tiantang' => [
                    '_referenceable_type' => [
//                            'Article' => ['order' => 1, 'type' => 'suggest',],
                        'Person',
                    ],

                    'title' => '天堂里没有车来车往——读《数学之恋——纪念旅美华人黄渝》',
                    'intro' => null,
                    'author' => '融融',
                    'date' => '2006-01-06',
                    'url' => 'http://wxs.hi2net.com/home/blog_read.asp?id=16&blogid=12494',

                ],
                'newspapers' => [
                    '_referenceable_type' => [
                        'Person',
                    ],

                    'title' => 'email from Valerie with Westfield Home News Delivery Service',
                    'intro' => null,

                    'author' => 'Valerie',
                    'date' => '2005-01-20',
                    'url' => '//groups.yahoo.com/neo/groups/ourfriendhuangyu/conversations/topics/106',

                ],
            ]
        ];

        $persons = [
            'Zi' => [
                'name' => '资中筠',
                'birthday' => '1930-06-01',
                'birthday_level' => 'yy',
                'deathday' => null,
                'deathday_level' => null,
                'place_id' => '耀华',
                'place_intro' => '天津，中小学时代',
                'family' => '祖籍湖南耒阳，资中筠的母亲童益君是浙江湖州人，外祖父当过地方官，当时江浙一带既是鱼米之乡又得风气之先。外祖父对子女的教育很开明，他逝世很早，家道中落。外祖母力排众议，把给三个女儿准备的嫁妆钱都用作学费，让她们上新学堂。这在当时是非常了不起的举动。我则受母亲影响，喜欢性格干脆，不喜欢哭哭啼啼、自怜自艾的人。<<zongpu>>

童益君事业蒸蒸日上，她曾经抱定了晚婚甚至不婚的信念
转载 成都道昭明里资耀华旧居:布衣银行家的家庭影集_shencec_新浪博客
http://blog.sina.com.cn/s/blog_6b8c8c3d01012lh1.html
',
                'missing' => '
- 没有可信来源，目前只发现国内的百科上有：资参加了尼克松访华以及随后的美国参众两院领导人访华团的全程接待工作，并参加基辛格若干次访华的接待工作。接待并陪同过一些在长期隔绝后初次重访中囶大陆的美方人士，如谢伟思、费正清、拉铁摩尔、斯诺的先后两位夫人、夏仁德等

- 这发生在80还是85年？“随着阅历的增加，我心中不以为然而又必须照上级意思办的情况越来越多，也越来越不能忍受。”资中筠说，她生病动手术、打麻药之际，忽然有个想法：“如果一病不起的话，我有什么遗憾？”结果她发现连没有做完的事情都没有，甚至不能说“赍志以没”，她觉得太遗憾了，觉得应当做一点符合自己特点、有长远意义的事情。
http://news.ifeng.com/shendu/zgxwzk/detail_2014_01/17/33123943_0.shtml
可询问记者刘炎迅，有态度的人物报道 微信订阅号《有个故事》http://liuyanxunvip.blog.sohu.com/300537729.html
                '
                ,
                'comment' => '逝世时间为纽约时间凌晨',
                '_experiences' => [
                    '幼年' => [
                        'title' => '',
                        'body' => '1930年出生于上海，资父在上海商业储蓄银行社会调查部工作。1935 年，资 5 岁，在美学习归来的父亲赴华北金融中心天津，任天津分行经理，一家随迁。
                         
3 岁时，早晨起来正好下雨，母亲一边给资穿衣服，一边吟春眠，用她的方言湖州调吟。<<zhong_wen>>
                         ',
                        'display' => 'persons',
                        'start_date' => '1930-06-01',
                        'start_date_level' => 'mm',
                        'end_date' => '1935-01-01',
                        'end_date_level' => 'y',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '上海黄浦江 宁波路附近',
                            'place_name' => '上海',
                            'comment' => '资耀华工作的上海商业储蓄银行开在上海租界的宁波路',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '中小学' => [
                        'title' => '较早的「乱翻书」是小学五、六年级',
                        'body' => '在耀华学校上小学、初中、高中 ；另外，小学五、六年级避水灾到上海。<<suzhi>>

当时日本侵略中囶以后，父亲资耀华奉命留守天津，借租界的庇护保护上海银行的财产。在英租界的家长们有的把孩子送到国际学校，当时天津有一所英囶学校，据说上完那所学校就可以直接去英囶。也有一所学校是法囶人办的。那个学校一切都是外文，当然也有中文课，但中文就非常差了。我母亲就坚决反对，她认为中囶人就要学好中文，坚持让我上中囶学校<<zhong_wen>><<li_cheng>>

1938 年，小学二到三年级的暑假，校长赵君达（赵天麟）遭日本特务暗杀。课堂上大家鸦雀无声。老师进来后哽咽不成语，她说了什么我已记不得，但记得一句话，就是“我们不能忘了这一天”。这的确是我终身难忘的一课。<<suzhi>><<sohu>>

较早的「乱翻书」是小学五、六年级，1939 年夏秋天津发生大水灾和疫情，读高小的资中筠随家人避到上海舅舅家，「他家有一个壁橱，堆满了各种新老书籍，没有整理。我没事就钻进去弄得灰头土脸，着实狼吞虎咽看了不少书。从武侠、神怪到红楼梦、到巴金的《家》、《春》、《秋》，冰心的《寄小读者》，还有翻译小说：福尔摩斯、大仲马、莫泊桑，等等，真正的“乱”翻书，完全自由放任，生吞活剥，没人管，也没人指导。不过每遇有趣的东西、或有心得，就与年龄相仿的表姐们交流、传阅，乐趣盎然。」<<zhong_wen>>通读巴金的《家》，为主人公受封建礼教摧残致死而义愤填膺。<<xin_yi>>

1941 年太平洋战争爆发后，日本势力进入租界，日语取代了英语，但被全校上下抵制。「我们的继任校长软磨硬抗」，同学们不约而同地消极抵制，如果别的课成绩好是荣耀，而如果日文念得好就被人看不起，学习了4年日语，资中筠只会字母。日本占领后加了“经训”课，就是读四书五经，「现在人们的想法是相反的，似乎『读经热』、弘扬传统文化以抵制“西化”被认为是爱国的，可是当年日本人却用这个手段阻断我们现代化的道路，让我们念古书，回归传统，以便于统治。」「在沦陷区的人，除了少数地下党我们不知道外，都是认同重庆中央政府的。许多人偷听重庆的广播。要知道在沦陷区偷听重庆的广播是有罪的，日本人还曾专门到各家搜查。」<<li_cheng>>

初中课本一篇文章是“郭子仪单骑退回纥”，选自《资治通鉴》。老师讲得特别生动，使资对郭子仪和《资治通鉴》产生了很大的兴趣。父亲一位朋友送了她一套《资治通鉴》 「那年暑假没事，就开始出于好奇，真的从头一本一本地看《资治通鉴》」。后来因缘际会，遇到郝姓老师讲《左传》。「他的启蒙好像为我打开了一扇门，不仅是对《左传》，而是整个春秋战国时期的人物和故事在我心目中活起来了。」「我举这段经历是要说明一种自然的熏陶，也没有人逼着我去这么做。」<<zhong_wen>>

在校在家长期的古文阅读，「得到的感染不是三纲五常、忠孝节义」，留给她深刻印象的，是：士大夫的忧患意识；厌战、渴望和平；民间疾苦；政治和爱情难以区分；隐逸情怀，逃离官场。

1945 年，高一暑假，「抗战胜利的时候，在所有的地方都播放了蒋介石对沦陷区同胞的一个讲话，第一句话就是『我亲爱的同胞们』，大家都感动得落泪，觉得未来一片光明。」这种感觉与 1949 年在广播中听毛说「中囶人民从此站立起来了」是完全一样的。<<li_cheng>>

中学时，资师从名师刘金定，学了六年钢琴，是老师三大弟子之一（两位师姐都考取音乐系后来成为钢琴教授），1947年高中毕业时，在钢琴老师力主下，举办个人钢琴演奏会。

',
                        'display' => 'persons',
                        'start_date' => '1935-06-01',
                        'start_date_level' => 'mm',
                        'end_date' => '1947-06-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [
                            [
                                '_place' => '昭明里',
                                'comment' => '家里的房子是向“北四行”租的，所以租金便宜，是英租界五大道成都道上的一栋假三层小楼',
                            ],
                            [
                                '_place' => '耀华',
                                'old_name' => '耀华学校',
                                'comment' => '好像是中小学分开的，且统一名曰：耀华学校',
                            ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '大学' => [
                        'title' => '音乐室和图书馆。大学三年级遇 49 之变',
                        'body' => '当时学校自主招生，心仪图书馆好的清华大学，但有优势的数学没发挥好，清华的白话文作文让擅长文言文的资难于发挥；成功考取燕京大学数学系，后发现自己并非数学天才，一个月后转入外文系。燕京大学有各种的学生“团契”，除了少部分传统的，绝大部分团契都是地下党反政府的平台，资中筠“对这两头都格格不入，都不愿意参加，所以比较孤立。”<<mi_xin>><<zhong_wen>><<li_cheng>>

第二年，自断后路，果断退学，只为考取清华。「那一年暑假，住在北京的一个亲戚家，每天跑北平图书馆，那时候北图在文津街，借书特别方便。我中午就买一个烧饼，一整天就在里面读书，一个暑假就在北平图书馆。上午复习要考试的东西，下午就随便看《西厢记》那些东西。」<<zhong_wen>><<chen>><<li_cheng>>

进入清华后，学校的音乐团体就来找她，常到乐声飘荡的灰楼音乐室练琴，大学生活是宿舍、图书馆、音乐室三点。<<chen>><<ming_yuan>>

与同学冯锺璞（宗璞[pú]）成为至交，「来宿舍，只有我一个人在，我们就天南地北地聊起来，大半都是谈读过的书，古今中外，各舒己见。古人中她最喜欢苏东坡，达到神交的地步，诗则欣赏李义山，认为有「空灵之美」，这些都深得我心。印象最深的是谈《红楼梦》，我们不约而同地喜欢探春。越谈越投机，相知恨晚，那年我十八岁，她二十岁，是为订交之始。」<<zongpu>>

1949 年初，天津和北平被占领。之前父亲正在美国考察，他不顾友人挽留，执意回到炮声渐近的天津，在当时金融界引起轰动，因为当时很多人选择外逃。校园里时时回荡起「解放区的天是明朗的天」。　<<li_cheng>>

四年级，1950年，资中筠为写毕业论文，开始享受入图书馆书库的特权：「第一次爬上窄窄的楼梯进得书库，望着那一排排淡绿色磨玻璃的书架，真有说不出的幸福感，外加优越感——自以为是登堂入室了。同时又有一种挫折感：这一片浩渺的书海何时能窥其万一？」<<ming_yuan>>

但从三年级 49 年起，校园内各种运动、政治学习，对知识宝库的流连逐步让位。49 年冬天，清华学生曾到海淀农村参加土改复查，几个星期和农民同吃同住，资深为农民的穷困生活状态震惊，「被认为是富农的人都那么穷，破破烂烂的，开始为自己原来享有的优越生活感到内疚」。一首土改歌曲《谁养活谁》更触动了资中筠的灵魂。在学校听政治学习报告，其中说，大概400个农民一年的生产才能养活一个大学生。所以，她越来越觉得自己是欠了农民的，对“政治学习”开始接受。<<li_cheng>>

父亲资耀华衷心拥抱新政权，也劝她「在政治上求进步」<<xin_yi>>

1950 年朝鲜战争爆发。官方“宣传”南朝鲜在美帝支持下挑起了战争，并放映朝鲜人民被侵略者残酷杀害的电影，这些让资中筠彻底转变，她接受了官方论断：世界上分成两大阵营，不站队是不行的，不站在革命的一边，就是站在反革命的一边。资中筠决心以新的意识形态好好改造自己，她和 90% 的清华同学一样，积极报名参军。她的行动得到了父亲的支持。清华学生参军因“国家需要”多未获批准，但留下的都很自豪，自以为是国家的宝贵财富。从此以后，资中筠对所有官方宣传都深信不疑，「觉得祖国前途光辉灿烂」。<<li_cheng>> 

她无法安于筹备毕业论文，作为班长，资代表全班向系主任请愿，要求取消毕业论文，让同学们有更多时间投入社会活动；毕业时面临史上第一次全囶“统一分配”、不准自选职业，各大专院校集中进行了大规模的「服从祖国需要」的“学习”，资发起班里全体女同学爬到教学楼顶，在红旗下宣誓「把一切献给祖国」，后来资又在全校大会上表态，坚决服从全国统一的“毕业分配”，到祖国需要的地方。<<xin_yi>><<ming_yuan>><<zongpu>><<dao_tong0>>
                        ',
                        'display' => 'persons',
                        'start_date' => '1947-09-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1951-06-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [
                            [
                                '_place' => '北京大学',
                                'old_name' => '燕京大学',
                            ],
                            [
                                '_place' => '清华',
                            ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '政务院文教委员会' => [
                        'title' => '与过去决裂',
                        'body' => '和好友宗璞一起“分配”到政务院文教委员会，本来是专业对口的对外文化联络局，但报到时被宗教事务局留下了，「我们不高兴，当然也没有办法，那时候得服从分配。后来我不太安心工作吧，还被批评了。」<<chen>>

工作不到半年，“三反”、“五反”运动开始，“进步民主人士”的父亲停职反省，天津报纸头版头条批判他是“大奸商”。资本人成为「重点帮助对象」，单位“动员”她与家人划清界限，坚信「党永远是对的」不动摇的资遂与父母疏远：「那时很诚实，也容易“犯傻”」，「觉得应该表里一致，不能在单位、在机关说划清界限，在家里又和他们聊家长里短、嘘寒问暖……」，「要坦白思想，很多人都保留点不说，『我是向组织坦白一切』，把父母的家信全部交出来」。受一同学启发，想登报申明与“资产阶级”父亲脱离关系，未被“组织”批准。凡是给家里写信，就得给单位审查，于是不再通信。煎熬半年，父亲又成为「完全守法」，不久被调离银行到北京从事金融史料工作，但和批判时相反，一切静悄悄的，资毫不知情。但「从那开始，我就老检讨，老得跟家庭“划清界限”，老得“改造”，没完没了。」<<li_cheng>><<xin_yi>><<chen>><<shi_zi>>


                        ',
                        'display' => 'persons',
                        'start_date' => '1951-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1952-06-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '北京',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '“中国人民保卫世界和平委员会”' => [
                        'title' => '',
                        'body' => '
在冷战背景下，苏联带头成立“世界和平理事会”，中国也相应成立“中国人民保卫世界和平委员会”（简称“和大”），这是和工会、青年团、妇联并列的所谓“群众团体”，当时并称“工青妇和”，主要从事国际工作。具有英法双语能力的资中筠，被调入这个机构的国际联络部，翻译信件、服务国际会议和外事接待。<<shi_zi>><<li_cheng>>

「我们大学毕业时，因为历史相对简单，可以到外事一线工作，逐步替代那些解放前就业的知识分子，但我们只是暂时被信任。领导说现在还用你们，是因为工农子弟还没成长起来，如果不加紧改造自己，等“我们自己的子弟”进来时，你们就要被淘汰。」<<mi_xin>>

1953 年，挚爱音乐的资烧掉了中学毕业时的独奏音乐会纪念册。「我感到当时别人在为“新中国”浴血奋战，我却沉浸在小资产阶级的钢琴调中，很羞愧，就一把火就烧了」，与过去决裂。「平心而论，那时是完全自觉的，没有人要我那么做。」<<new_jing>>
                        ',
                        'display' => 'persons',
                        'start_date' => '1952-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1956-06-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '北京',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '“世界和平理事会”' => [
                        'title' => '不安',
                        'body' => '派驻<z-lang lang="en" title="维也纳"> Vienna</z-lang>，任“世界和平理事会”书记处中国书记的助手及翻译。此机构专职配合苏联外交宣传，成员自由受限，「出门必须两人同行」。<<chen>><<nanfang>>

因为外派，幸运躲开了「反右」。「出囶之前，已经在开始学习『娜斯佳精神』，号召大家敢提意见。“和大”的青年团组织专门开会讨论给领导提什么意见，这就是“鸣放”的开始，正在这个节骨眼上我被派出去了。」 1957 年短暂回囶，好多同事正在被批判，「如果我先在国内，一定参加“鸣放”，我很可能变成“右派”，因为我对党是无所保留的；假如没参加“鸣放”，“反右”运动中留在国内，我又很有可能变成积极分子，批判别人。因为那个时候自己没脑子，只知道紧跟。所以我回想起来，觉得自己特别幸运，既没有变成右派，也没有做现在想起来对不起人的事。」<<li_cheng>>

和同事陈乐民相识、相恋并结婚。<<chen>>

被歧视为“三门干部”，从家门到学校门到机关门，没有经历过与工农相结合；但又因“工作”需要，总派到囶外，不让“下放”，在外生活，内心不安。1958年听闻囶内“大跃进”热火朝天，「我们很遗憾不能参与，将来共产主义建设成功了，少了我们的参与，觉得非常遗憾。」1959年，听闻囶内开始物资匮乏，定量配给，对“自然灾害”之说当然毫不怀疑，认为在囶外「养尊处优」心里非常不安，「这是非常真诚的」，于是向领导申请调回囶和人民，为的就是与人民一起挨饿（但回囶原因是中苏反目成仇）<<chen>><<xin_yi>><<shang_jiao>><<ji_huang>>
                        ',
                        'display' => 'persons',
                        'start_date' => '1956-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1959-06-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Vienna',
                            'point_to' => 'Vienna',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '“中国人民保卫世界和平委员会”' => [
                        'title' => '劳动强度很大。「只觉得跟大家一块挨饿比较安心……」',
                        'body' => '回囶后回到“和平委员会”，做同声翻译。「1959 到 1966 年之间，还是不断开会。中苏分歧之后，内容就是跟苏联吵架。」<<chen>>

1960 年，为了“改造”，丈夫陈乐民申请“下放”劳动，一次饿昏，滚到水沟里。幸亏一个老乡看见了把他给救起来。怀孕留在北京城的资中筠从未有呕吐、挑食等一般孕妇的反应，对怀孕的记忆只有饥饿感，一次错过食堂而得到在家里养鸡的同事招待米粥和烙饼摊鸡蛋，「吃罢周身暖和。此一饭终身难忘」。稍后，个人养鸡被禁止。<<ji_huang>>

1960 年 5 月女儿出生。「母亲托一位亲戚从农村弄来一篮鸡蛋。那时报上正在大力批判农村自由市场，说是“挖社会主义墙角”云云。我就认定那鸡蛋一定是从自由市场来的，拿出“耻食周粟”的精神，坚决拒吃」。产假未满便被派出囶，靠着父亲作为“糖豆干部”的特供，才让女儿喝上了牛奶。当时孩子交给母亲。但单位有人提出说"资产阶级"跟我们争夺下一代，资只好坚决送女儿去幼儿园全托，母亲接送，但接了几次"群众"又有声音，于是连母亲接送都免了。<<ji_huang>><<xin_yi>><<father>>

随着出囶人员在外购买食品日益成风，国际上对中囶经济情况也议论纷纷。于是传达了一道命令：临时出国人员不得在国外购食物回国，以免损害国家形象，「授人以柄」。1963 年到莫斯科参加国际妇女会议，这类会议已成为中苏吵架场所，在那个“不爱红妆爱武装”的年代，会议前特别交代：大家要注意仪表，脸上化化妆，免得在各国花枝招展的妇女群中显得“面有菜色”，人家更要说我们是饿的！<<ji_huang>>

浮肿后，早上一起来眼睛就睁不开，身上一摁一个坑。因工作需要经常出囶，「每到国外，两三天后浮肿自然消减，有一种忽然神清气爽的感觉」。可是她没有过怀疑：「“上面”说是自然灾害，就是自然灾害，从来没有想过为什么会造成这种局面，更没有怀疑过政策上有什么错误，我们从来没有怀疑过。」没有人问过「为什么」，「只觉得跟大家一块挨饿比较安心……」。<<li_cheng>><<ji_huang>><<xin_yi>>

与“反右”以知识分子为重点不同，“反右倾”时机关中批判的对象多为家在农村的干部，因了解家乡情况在机关中“发牢骚”而获罪。<<ji_huang>>

受领导重用，「一年要出囶八次，不但代表本单位的，而且被别的单位借调。比如说，五一、十一毛主席、周总理在天安门接见外宾，我总会上天安门，当时我自己没有觉得什么，但是同事看在眼里，可能会觉得什么」。同时因为严重的饥荒，单位领导以资工作特殊为由，乘机向主管廖承志申请补助，不少同事喝上了牛奶，但「名单如何定的，不得而知」。这成为后来在 Cultural Revolution 中被攻击的问题。<<chen>><<ji_huang>>

劳动强度很大，现在的同声翻译须一个钟头换一个人，当时做同声翻译是一个人钉到底的，连续8到10小时是家常便饭，有时24小时熬通宵。「等到安排代表团参观的时候，比如去划船，我就睡着了」长期的营养不良且和劳累过度而终于病倒，1964 年不得不完全中止工作治疗，休养了一年多，Cultural Revolution 爆发。<<chen>><<li_cheng>>


                        ',
                        'display' => 'persons',
                        'start_date' => '1959-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1969-06-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '北京',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '“干校”' => [
                        'title' => '认真学农。只敢腹诽',
                        'body' => '毛发起“Cultural Revolution”，资被要求揭发成为“牛鬼蛇神”的好友宗璞<<zongpu>>；资本人在单位被一些年轻人贴大字报，称领导的干部路线有问题，重用资产阶级出身的人，于是成为“修正主义干部路线”的典型，被打入另册。 不久，“下放”到京郊干校，每两周能回一次家。<<chen>><<mi_xin>>

1969 年，林彪「一号通令」后，整个机关下放，资全家连小孩子一起都到河南“干校”。一家人起先是男女分开住集体宿舍，大通铺；后被分给一间房；然后住到当地农民家里；后来自己建房子，先从做泥胚砖开始。<<chen>> 
                        
资中筠觉得不可能回到城市，做了长期做农民的打算。认真学农活，「怕一旦完全靠劳动吃饭自己养不活自己」。<<xin_yi>><<chen>>

目睹农村之落后、农民之苦，完全与她所相信的宣传差距太大，资开始怀疑。对“最高指示”的怀疑，起于有人传达毛对姚文元读书的批示：「很好，继续努力，必有成效」（大意），资中筠忽然觉得，「读这些书有什么了不起，我大部分都看过。8亿人只有一个人替大家读书，读这么点儿书还要最高领袖赞扬。我突然觉得这事有点儿荒唐。」怀疑就像一株嫩草，终于从石头缝里钻出来。<<li_cheng>>

对于心中的怀疑，资中筠不敢说、不敢写，只好选择“腹诽”。资曾读到遇罗克的《出身论》，内心赞同却不敢表达。遇罗克在 1970 年被判处死刑后，资中筠内心仍有害怕：幸好没说，不然的话，「我不也可能被枪毙了？」<<xin_yi>>


                        ',
                        'display' => 'persons',
                        'start_date' => '1969-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1971-08-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '河南颍河周口下游',
                            'point_to' => '河南周口',
                            'comment' => 'http://read.jd.com/15720/757862.html 资中筠的思想历程（7） ',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '中国人民对外友好协会' => [
                        'title' => '越来越感到厌倦',
                        'body' => '
1971 年，尼克松访华前，外事人员对国家有了使用价值，资中筠从干校调到中国人民对外友好协会美洲与大洋洲处（美大处），参加了尼克松访华。先任美国组组长，后任美大处副处长，主要从事外事接待工作，还有一种工作是为中国主持的各种国际会议（联合「第三世界」和国际毛派「反帝」「反修」）翻译发言稿。<<chen>><<shi_zi>><<li_cheng>>

中美关系解冻，美国民间人士开始频繁来访。她「有了一个非常特殊的机会接触到美国社会从左到右、从上到下的各色人物，从后来任总统的杰拉尔德·福特（他第一次来华访问时的身份还是国会多数党的领袖）到失业工人、右派资本家、自称‘毛主义者’和激进的黑人民权斗士都有」。<<shi_zi>>
                       
资在工作中，「接触到都是美囶人，那时候不是正式研究美囶，但是对美囶的情况慢慢地就比较了解」。<<chen>> 1979 年，第一次访问美国。

林彪事件以及后来“批邓”的反复，终于让宁愿饿死也不失节、不肯吃“挖社会主义墙角”鸡蛋的资中筠感悟到，「它的逻辑太荒唐了」、「实在没法跟了」。 资中筠认为，“批邓”是一个转折点，「大家开始怀疑毛，但是对 system 还不敢怀疑，而是认为如果那些老干部出来工作，大概就会好了。」 <<xin_yi>><<li_cheng>>

丈夫陈乐民回忆说，当时中囶很穷，接待却不惜血本，请来的人吃住都是中国出钱，而且大多是左派，只会说好话，不会说坏话。正是在这样的接待工作中，资中筠和陈乐民逐渐感到，作为知识分子，独立和自由的思考是何等重要。<<chen>><<nanfang>>

学校毕业后长期从事的外事翻译工作只是“被分配”，并非初衷，「兴趣索然」，后来越来越感到厌倦。<<lvli>><<xin_yi>>
                        ',
                        'display' => 'persons',
                        'start_date' => '1971-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1972-01-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '北京',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '中国国际问题研究所' => [
                        'title' => '',
                        'body' => '50 岁的资对「需按口径说话」、「迎来送往」的工作越来越厌倦，而随着改革开放，「要求调工作不再算大逆不道」，适逢一场生病，「忽然就想独立了，不想再事事听命」，以身体不好为由，主动申请调入了拥有一个好图书馆的外交部国际问题研究所，开始了学术生涯，是年 1980 年，「那时在外交系统从“一线”到研究所通常被认为是一种“贬黜”，犯错误的干部一般安置在那里，我是第一个主动要求去的」。<<lvli>><<nanfang>><<shi_zi>><<mi_xin>>
                        
被分配到美国研究室，「那时候美囶越来越是重点了。也不是我自己选择非要研究美囶不可，但是自然而然地就变成非得研究美囶了。」<<chen>> 

研究所的图书馆，国际问题研究的资料收集最全，管理最好。可以看到美国国务院历年解密外交档案和美国国会辩论的记录。只有两个地方有特权引进这种档案，一个是外交部，一个是上海复旦大学（Cultural Revolution 时被定为培养工人大使）。「我去了之后感觉如鱼得水，天天在那儿看档案。」<<nanfang>> 
	
1981年，她托人买到一架钢琴，重拾旧好。

                        ',
                        'display' => 'persons',
                        'start_date' => '1980-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1985-01-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '中国国际问题研究院',
                            'old_name' => '中国国际问题研究所',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '中国社会科学院美国研究所' => [
                        'title' => '「从改革开放起，思想开始解放，到上世纪80年代末，思想又大解放一次。」 ',
                        'body' => '资撰写《中美关系中台湾问题之由来》长文，碰巧中美正在进行关于美国售台武器的谈判，引起了非常大的关注。 一次出囶飞机上碰到李慎之，相谈投机，被邀请进入中国社会科学院刚筹建的美国所，资经过争取和努力，1985 年进入美国所任副所长。丈夫陈乐民两年前到了欧洲所。<<nanfang>><<chen>>
	
1987 年，参与创办《美国研究》杂志，<<《美国研究》十周年纪念致词 资中筠:http://wenku.baidu.com/view/084863e5be1e650e52ea99ea.html>>，开始着手《战后美国外交史——从杜鲁门到里根》（1993 年初，书稿杀青） <<zhan_hou>>。

1897 年搬入东总布胡同，条件改善，夫妇二人「各自有了专用的书桌」。<<不尽之思>>
	
1988年任美国研究所所长，同时任研究员，博士生导。强调用对待一个文明的角度来研究美国，而不仅是对待一个超级大国。<<nanfang>>

第二年，资中筠作为所长，既要“交代”自己的思想，又要负责“清查”手下所有人的动向。 「我那时候非常痛苦，就下决心不再说违心话了。」她没有勇气振臂一呼，只能消极抵制，不参加表态会，对所里的年轻人也采取「能保就保，能瞒就瞒」的态度，使所里无人得到处分。资深感自己不适合担任所长，因为在所长的岗位上，有很多不自由：「不是行政上的不自由，而是你必须说你不想说的话，或者是去贯彻你不赞成的政策。所以我下决心：在尽可能范围内，我要自由」。1991 年底坚决辞任所长当研究员，1992年出访华盛顿威尔逊国际学者中心做了一年访问学者。<<xin_yi>><<dao_tong0>>

1993 年初，蹉跎六年的《战后美国外交史——从杜鲁门到里根》书稿杀青，资要做索引，出版社不肯花这个力气，资便找了一位年轻人做助手，亲自做，「国际上学术著作索引是惯例，而中国至今不普遍，这是很大缺陷。」<<shi_zi>><<zhan_hou>>

                        ',
                        'display' => 'persons',
                        'start_date' => '1985-01-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1996-07-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '中国社会科学院美国研究所',
                        ], [
                            '_place' => '北京东总布胡同',
                        ]],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '退休后：我最高兴最有成就的20年' => [
                        'title' => '「人生不满百，常怀千岁忧」',
                        'body' => '
1996 年退休，继续专业领域的研究工作和学术活动。 在专业领域之外，「更为重要的工作是祛魅和自我启蒙，我对中华民族的命运与发展有了更深层次的关切和思考，写了大量的随笔和评论结集出版，它们比我的学术著作影响更大。」<<new_jing>> 
- 2000 年出版《追根溯源：战后美国对华政策的缘起与发展》，《冷眼向洋：百年风云启示录》。后者是多人合著，2007 年新版各人单独成册，资著名为《二十世纪的美国》，讲述了美国崛起的过程；资非常看重这本书，「切入点是从人类的两大基本诉求——发展和平等出发，看一个国家、一个制度如何在二者之间找到平稳发展的途径」。<<shi_zi>>
- 2011 年五卷本《资中筠自选集》。《感时忧世》针砭时弊，《士人风骨》解剖中囶士人和知识分子， 《闲情记美》讲作者的书卷历史、域外经历和音乐情缘，《坐观天下》专业论述国际问题，《不尽之思》是对故人旧事的回忆。
- 2013年12月，出版两本新书《美国十讲》和《老生常谈》。《美国十讲》是资 2012 年一个系列视频的合集，在修改过程中，她反复翻看美国制宪会议的记录，逐渐明确「美国是一个谈出来的国家」，「13 个邦不是谁把谁打败了，从根本上讲，他们的观念和立国之本就是和我们不一样的。」《老生常谈》是对各种社会问题的发声，「题材庞杂，东拉西扯」，谈到了人治和法治，公民教育，国家观，以及社会良知等等。<<shi_zi>>
- 2015 年出版《财富的责任与资本主义演变》（ 2003第一版名为《散财之道》，二三版名为《财富的归宿》），这本书体现了一个道理：慈善不是站在资本主义市场经济的对立面。<<caifu>> 作为第四版，此书增补新内容“新公益”，「不把穷人当作单纯受捐赠者，而是潜在的创业伙伴」，「这不是“资本家发善心”，纯粹利他主义，也不是虚伪的既想赚钱又想落慈善之名，而是对社会的深刻的危机感和责任感。当然，不言而喻的底线是对人生而平等的信仰。如一位银行家所说：一个社会如果不能让多数人分享繁荣，就不能算民主社会」。<<caifu_zishu>>「创投公益的模式……在美囶得以发展成规模……更重要的是基本的诚信氛围。就在这种情况下，还有许多风险和挑战，其倡导者需要经历不少艰难险阻，只有理想坚定、有坚忍不拔的献身精神者最后获得成功」。<<caifu_xu>> 一位发起创办阿拉善基金会的企业家说，他是受了这本书的启发。<<shi_zi>>
 
除了专业研究和自由写作，资在社会的推动之下，也通过接受报刊采访，参加启蒙辩会、理想国沙龙、世纪大讲堂等各种文化活动，传播理性和常识。<<xin_yi>>

退休后的资，「开始返回自我，受到外界的禁锢越来越少。思想进一步解放，说真话的可能性和欲望都增大了。」、退休的 20 年是「我最高兴最有成就的20年，能自由写作，自由思想」。就个人的兴趣而言，资总是很想能够平静一下，原来想象的退休生活是散淡平静的，但「处于目前的社会状况下，我觉得风花雪月已经太奢侈了」，「每见种种悖理伤道之事，忧思难解，悲愤不已」，「生活上，我没有任何不满足的，我清心寡欲，衣食无忧。但我不能不关心外面的事情，这是种本能，我看到很多问题，看不到解决的方案，一想到民族前途，我就忧心忡忡。」<<new_jing>><<shi_zi>><<shang_jiao>>

2008 年，相守半个世纪的伴侣、工作和事业以及精神上的同路人、欧洲研究专家、暮年病重仍孜孜不倦写作《启蒙札记》的陈乐民先生去世，享年 78 岁。

「如果没有公共活动，每天我大概花6小时读书、写作，累了就弹几十分钟钢琴，弹钢琴时我很快乐，这是一生的爱好，钢琴能给我带来很多乐趣。」<<new_jing>> 2011 年，记者看到资家中钢琴上堆着一摞贝多芬的曲谱，她时常独奏「老三篇」《月光》、《热情》与《悲怆》，而门德尔松《谐谑曲》、柴可夫斯基的《胡桃夹子》等年轻时酷爱的轻快曲子，如今已少见于老人琴下。<<xin_yi>>

                        ',
                        'display' => 'persons',
                        'start_date' => '1996-07-01',
                        'start_date_level' => 'yy',
                        'end_date' => '2030-01-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '芳古园',
                            'comment' => '晚年资中筠居住在北京南二环芳古园 http://www.nbweekly.com/news/people/201111/28298.aspx',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                ] // _experiences,
            ], // a person end   Zi
            'Thomas_More' => [
                'name' => 'Thomas More',
                'birthday' => '1478-02-07',
                'birthday_level' => 'dd',
                'deathday' => '1535-07-06',
                'deathday_level' => 'dd',
                'place_id' => 'milk',
                'place_intro' => '',
                'family' => '
父亲 <z-family role="father">John More</z-family> (1451–1530) ，律师（barrister），1520 年开始在 the King’s Bench 任法官，直到去世。<<wiki-father>> Thomas More 在他的墓志铭称他「<z-lang title="Homo civilis, suavis, innocens, mitis, misericors, eequus et integer" code="la">彬彬有礼、交谈中甜美快乐、纯真温柔、仁慈、公正清廉</z-lang>」。<<google-ebook:10>>
母亲 <z-family role="mother">Agnes Graunger</z-family> (–1499), 是伦敦商人和市议员 Thomas Graunger 的女儿。<<wiki-father>>
Thomas More 有一姐一妹，三个弟弟早逝。<<wiki-father>>
',
                'missing' => '
                - missing
                ',
                'comment' => '出生年份现在有 1477、1478 两种说法 <<lincoln>><<google-ebook-source>>',
                '_experiences' => [
                    '在<z-lang title="伦敦牛奶街" lang="en"> Milk Street, Cheapside</z-lang> 出生' => [
                        'title' => '',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1478-02-07',
                        'start_date_level' => 'y',
                        'end_date' => '1491-01-01',
                        'end_date_level' => 'y',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'milk',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    "St Anthony's School" => [
                        'title' => '',
                        'body' => '<p>幼时被送入圣安东尼学校，一所 Grammar School (以教授拉丁语为主)，是当时伦敦最好的学校之一。<<google-ebook>> 拉丁语是当年罗马教廷和欧洲知识阶层的语言，类似华夏的文言文。</p>',
                        'display' => 'persons',
                        'start_date' => '1485-01-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1490-06-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Anthony',
                            'comment' => 'Founded in 1440, it was destroyed in the Great Fire in 1666. Today’s school was founded by Richard Patton during the Victorian period and is now managed by the Alpha Plus Group. It moved to its Hampstead location after World War Two.'
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,

                    '在 John Morton 家做小侍者（household page）' => [
                        'title' => '',
                        'body' => '<p>Morton (1420–1500) 热情支持 New Learning (后世称为「文艺复兴」)，时任坎特伯雷大主教、英格兰大法官(Lord Chancellor) ，后任天主教会的红衣主教(1493–1500)、牛津大学校长(1494–1500)。 <<wiki-more>></p>
<p>Morton 非常欣赏 More 的潜力，1492 年把他送到牛津大学学习。</p>',
                        'display' => 'persons',
                        'start_date' => '1490-09-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1492-09-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Knole_House',
                            'comment' => '使用这个地点并不完美，但至少有道理。Morton died at Knole House, Kent https://en.wikipedia.org/wiki/John_Morton_(cardinal) .
                Sir Thomas More appeared in revels there at the court of John Morton  https://en.wikipedia.org/wiki/Knole_House'
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,

                    'Oxford University' => [
                        'title' => '',
                        'body' => '<p>学习希腊文、拉丁文、古典著作，撰写喜剧，研究希腊和拉丁文作品。<<more-list>> 他的两位老师 Thomas Linacre 和 William Grocyn , 都曾在文艺复兴中心的意大利访问、学习。<<wiki-more>></p>
<p>1494 年，在父亲的极力主张下，他离开牛津，走上法律职业的求学之路。(有观点说：More 的不情愿是 Erasmus 的个人看法，从 More 的生涯看，他看起来成功地平衡了自己的人文兴趣和对法律的投入。<<more-edu>>)</p>
',
                        'display' => 'persons',
                        'start_date' => '1492-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1494-06-01',
                        'end_date_level' => 'y',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Oxford',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    'New Inn, 一所大法官学校(Inns of Chancery)' => [
                        'title' => '',
                        'body' => '<p>以出庭律师(barrister)为职业目标的学生在这里主要学习基本的法律常识、实用性技术，经过几年学习后再转入律师学院学习。</p> <<lincoln>>',
                        'display' => 'persons',
                        'start_date' => '1494-06-01',
                        'start_date_level' => 'y',
                        'end_date' => '1496-02-01',
                        'end_date_level' => 'm',
                        'comment' => '
                        英国律师制度演化 
                        http://www.mockingbird.cn/community/post/64.html
http://www.jgzyw.com/zhuanyelunwen/shekelunwen/falvlunwen/sifazhidu/27/433926.html
',
                        '_places' => [[
                            '_place' => 'middle',
                            'point_to_en' => 'New Inn (attached to the Middle Temple)',
                            'comment' => 'The buildings of New Inn were pulled down in 1902 to make way for a road between Holborn and the Strand https://en.wikipedia.org/wiki/Inns_of_Chancery#Middle_Temple_attachments   New Inn肯定在Middle Temple 附近',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '<z-lang lang="en" title="林肯律师学院">Lincoln\'s Inn</z-lang>' => [
                        'title' => '1501 年成为律师',
                        'body' => '<p>More 的父亲当时是<z-lang lang="en" title="林肯律师学院"> Lincoln\'s Inn </z-lang>的一位主管委员(bencher)。 <<lincoln>></p>
<p>1499 年，Erasmus 第一次访问英格兰，More 和他成为密友，这是他们一生友谊的开始。<<more-list>> 关于More 的幽默感，Erasmus 写到 ：「从童年起他就非常喜爱诙谐逗趣，开玩笑似乎是上帝派他来到世上的唯一目的。他从不会流于滑稽可笑，但庄重和尊严永远不适合他。他总是和蔼可亲，温和宽厚，使每人遇到他的人都感到愉悦快乐。」<<ewtn>></p>
<p>1501 年, More 在家庭所在教区的  St Lawrence 教堂做了关于奥古斯丁《上帝之城》的系列讲座。<<more-edu>><<more-map>></p> ',
                        'display' => 'persons',
                        'start_date' => '1496-02-12',
                        'start_date_level' => 'd',
                        'end_date' => '1501-06-01',
                        'end_date_level' => 'y',
                        'comment' => 'wikipedia说1502取得律师资格，但其它地方都是说1501年,有的说是 c.1501 <<lincoln>>',
                        '_places' => [[
                            '_place' => 'lincoln',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '修道院' => [
                        'title' => '',
                        'body' => '<p>居住在 Carthusian 修道院附近，尽量按照 Carthusian 的方式生活，每天凌晨 2 点起床，开始几个小时的沉思、祈祷。<<faithful>></p>
<p>与此同时 More 从事律师工作，约在 1501 年在附属于林肯学院的Furnival\'s Inn, 任讲师 ( Reader in Law )，1503 - 1504 担任林肯学院账户审计员。<<lincoln>></p>
<p>More 非常钦敬修道院里的僧侣，但他对僧侣生活的渴望，最终让位于在政治领域服务囶家的责任感，More 于 1504 年竞选议员，次年结婚。<<more-list>> More 的好友 Erasmus 认为，More 是因为无法摆脱婚姻的想法，所以「选择做一个敬畏上帝的丈夫，而非做一个不道德的出家人( chose to be a god-fearing husband rather than an immoral priest)」。<<more-edu>></p>
<p>虽然选择了世俗事业，但他一直保持着一些苦行生活，譬如贴身穿着毛发衬衣，有时还鞭笞自虐<<wiki-more>>；祈祷、斋戒和忏悔的习惯也伴随了 More 一生<<more-list>> 。</p> 
',
                        'display' => 'persons',
                        'start_date' => '1501-06-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1504-04-01',
                        'end_date_level' => 'yy',
                        'comment' => 'wikiepedia说是Between 1503 and 1504， 但其它地方说是四年(此说应来自其女婿)。年份来源是： <<google-ebook-source:361>>',
                        '_places' => [[
                            '_place' => 'London Charterhouse',
                            'comment' => '//www.thomasmorestudies.org/map-lon-4.html https://en.wikipedia.org/wiki/List_of_Carthusian_monasteries#England',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '律师和文人生活' => [
                        'title' => '1504 年任议员',
                        'body' => '
<p>1504 年，竞选下议院议员并成功当选<<wiki-more>>。因为在议会阻止了国王亨利七世的一项费用开支，得罪了亨利七世，莫尔离开政界，回到律师界并从事人文科学和自然科学的研究。<<more-list>></p>
<p>1505 年与 Jane Colt 结婚，<<wiki-more>> 搬到 the Old Barge , 这个居所接连迎来了四个孩子的诞生（Margaret 1505, Elizabeth 1506, Cicely 1507, and John 1509），并且也足够大，接待了很多客人，包括伊拉斯莫。<<more-edu>><<google-ebook-a>><<mag>></p>
<p>1505—1506 年，伊拉斯莫第二次旅英，两人翻译公元二世纪希腊作家吕西安的作品。其间，莫尔将《约翰·皮库传》一书译成英文。1509年伊拉斯莫来英作时间最长的一次侨居，在莫尔的建议下，他在莫尔家中写出了杰作《愚人颂》。<<more-list>><<Pico>></p>
<p>尽管最终选择了世俗的职业和生活，但虔诚的 More 却继续保持着早起、祈祷、穿粗毛衫甚至禁食、鞭打自己的生活习惯。<<wiki-more>></p>
',
                        'display' => 'persons',
                        'start_date' => '1504-01-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1509-04-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Bucklersbury street',
                            'old_name' => 'the Old Barge, Bucklersbury',
                        ],],
                        '_children' => [
                        ],// _children
                    ],
                    '亨利八世即位后，返回政界' => [
                        'title' => '',
                        'body' => '
<p>1509 年 4 月，亨利八世登基，莫尔专门写诗庆祝，称“自由的春天到来了”（here\'s freedom\'s spring）。9 月，莫尔赴安特卫普(Antwerp)进行商业谈判，期间结识了人文主义者 Pieter Gillis。<<his>><<en.wikipedia.org/wiki/Pieter_Gillis>> 10 月，More 被选为亨利八世时期第一届议会的议员。<<his>><<Par>></p>
<p>1510 年 9 月至 1518 年 7 月，More 任伦敦司法副官（one of the two undersheriffs of the City of London ) <<his>>，在 Guildhall(市政厅) 处理大量的城市事务，针对各行各业伦敦人的法律事务向 sheriff 和市长提出建议<<guildhall>>，他诚恳、公正、干练，被誉为<z-lang title="a patron to the poor">穷人的庇护者</z-lang>。 <<more-list>><<wiki-more>></p>
<p>Between 1512 and 1519 莫尔用英文和拉丁文写了《国王理查三世史》，这是英国历史学的第一篇名著。</p>
<p>1515 年 5 月，经伦敦商人建议和市议会的批准，More 在密友 Cuthbert Tunstall 的指导下出使法兰德斯(Flanders)进行商业谈判。期间 More 开始用拉丁文撰写《乌托邦》。<<his>> 该书于1516年12月正式出版；1518 年 3 月和 11 月又推出了由莫尔亲自校订的两个新版本。</p>
<p>1517 年 More 出使加来( Calais )和法国人谈判。5 月，伦敦发生反对外国人的暴乱( Evil May Day )，More 在其中调解。<<his>><<Evil_May>> </p>
',
                        'display' => 'persons',
                        'start_date' => '1509-04-02',
                        'start_date_level' => 'yy',
                        'end_date' => '1518-01-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [
                            [
                                '_place' => 'Guildhall',
                            ],
                            [
                                '_place' => 'Ostend',
                                'point_to' => '佛兰德斯（中世纪欧洲一伯爵领地，包括现比利时的东佛兰德省和西佛兰德省以及法国北部部分地区）',
                            ], [
                                '_place' => 'Calais',
                            ]],
                        '_children' => [
                        ],// _children
                    ],
                    '在国王亨利八世身边工作' => [
                        'intro' => '',
                        'body' => '
<p>1518 年， More 被任命成为一名枢密院委员（ Privy Councillor. 枢密院，即 Privy council，国王的顾问机构，曾拥有立法、司法、行政等权力）。<<google-ebook-source:P362>> 同年，More 在恳请法院任法官（ Master of Requests 。恳请法院，即Court of Requests ，是一个衡平法而非普通法法院，最早是枢密院的一部分，接收穷人和国王仆人的诉讼）<<wiki-more>><<en.wikipedia.org/wiki/Court_of_Requests>>。</p>
<p>身为亨利八世的私人顾问，More 变得越来越有影响力：欢迎外国外交官、起草公文、做国王和大法官 Thomas Wolsey 的联络人。<<wiki-more>></p>
<p>152x 年，在 Beaufort 大街购买了超过20英亩的土地建造房子叫 Beaufort House。他是第一个在此建设的知名人士，后来亨利国王为了孩子的成长也来到附近建设。<<more-gov>><<more-st>></p>
<p>1520 年，马丁·路德连发三篇檄文，强调「因信称义」，反对教皇的权威，主张王权高于教权、建立国家教会。亨利八世出版小册子进行反驳，其中 More 参与了编写。</p>
<p>1521年，在陪同 Thomas Wolsey 等人完成一项外交使命后，受封为爵士并出任副财务大臣（under-treasurer of the Exchequer ）。<<wiki-more>></p>
<p>1523年，当选为国会郡选议员（knight of the shire），经沃尔西提名，当选为下院议长。<<wiki-more>> 这次议会的主要议题是对法战争的融资问题。<<his>> More 向国王请愿，议员应有言论自由，这是下议院特权史上的一个里程碑。<<more-list>><<his>> 年底，More 编写的  Responsio ad Lutherum 出版，回应路德对亨利八世的攻击。</p>
<p>1525 年受命接任去世的 Richard Winfield， 担任兰开斯特公国大臣（ Chancellor of the Duchy of Lancaster）<<wiki-more>><<legacy.fordham.edu/halsall/mod/16Croper-more.asp>></p>
<p>1527 年陪同 Wolsey 到法国巩固和平谈判。<<his>></p>
<p>1528 年，More 发表　A Dialogue Concerning Heresies 关于异端的对话 ,肯定教会的权威和传统。1529 年，More 发表 The Supplication of Souls 回应 Simon Fish 广泛传播的作品 Supplication for the Beggars </p>
<p>虽然国王对他极为推重，不拘礼节地约他一同进餐，还和他一起研讨数学和天文学，可是莫尔对此并不感到荣幸。他说：「假使我莫尔的人头能让他得到一座法国城池，这颗头准得落地。」</p>
',
                        'display' => 'persons',
                        'start_date' => '1518-01-02',
                        'start_date_level' => 'yy',
                        'end_date' => '1529-10-01',
                        'end_date_level' => 'mm',
                        'comment' => '进入枢密院的时间，1514,1517,1518三种说法, 这里采用的是<<google-ebook-source>>)',
                        '_places' => [[
                            '_place' => 'Beaufort',
                        ],],
                        '_children' => [
                        ],// _children
                    ],
                    '大法官（Lord Chancellor of England）' => [
                        'title' => '',
                        'body' => '
<p>1529年，亨利八世任命 More 为大法官（Lord Chancellor of England），这一职位仅次于国王，拥有立法、司法、行政等职能。</p>
<p>More 的前任 Thomas Wolsey 任职 14 年，下台的首要原因，可能是未能说服教皇允许亨利八世与王后凯瑟琳 Katherine 离婚<<Wolsey>>。</p>
<p>1530 年英格兰的贵族和高级教士联名写信给教皇，要他宣布亨利八世与凯瑟琳的婚姻无效，莫尔拒绝签名。</p>
<p>1531 年，通过清洗支持罗马教皇立场的高级教士，亨利孤立了 More．国王命令神职人员宣誓，承认国王是英格兰教会的最高首脑 Supreme Head。同年，More 发表五十万言的 Confutation of Tyndale’s Answer 回应对天主教仪式和教义的批评。<<wiki-more>></p>
<p>1532 年 5 月 15 日，英格兰教会向国王表示臣服，第二天，More 以健康理由提出辞职。<<his>><<wiki-more>></p>
',
                        'display' => 'persons',
                        'start_date' => '1529-10-01',
                        'start_date_level' => 'mm',
                        'end_date' => '1532-05-16',
                        'end_date_level' => 'mm',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Beaufort', // todo
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '赋闲在家：忙于笔战' => [
                        'title' => '拒绝宣誓',
                        'body' => '
<p>1533 年 5 月，英格兰教会的最高神职坎特伯雷大主教 Cranmer 宣布 Henry 与凯瑟琳的婚姻无效。亨利八世邀请 More 参加新王后加冕典礼，但是莫尔没有接受。</p>
<p>辞职后的莫尔，主要精力放在了宗教论战上，写了 Letter against Frith、The Apology of Sir Thomas More、等多部作品。<<google-ebook-source:364>></p>
<p>1534 年初，More 被指控是 Elizabeth Barton 的一个共犯（Barton 是一位反对亨利婚姻判决的修女）。<<wiki-more>></p>
<p>1534 年，议会通过《继承法案》、《至尊法案》（Act of Supremacy），宣布英王是宣布亨利八世为英国教会的惟一最高元首，有权召开宗教会议、任命教会各种神职和决定教义，教会向教廷缴纳的贡金一律上缴国王等。4 月 13 日，莫尔被召去要求宣誓，More 拒绝，坚持教皇至上的学说，并公开反对亨利的婚姻判决。17 日　More 被关进伦敦塔Tower of London。<<more-list>></p>
',
                        'display' => 'persons',
                        'start_date' => '1532-05-17',
                        'start_date_level' => 'dd',
                        'end_date' => '1534-04-16',
                        'end_date_level' => 'dd',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Beaufort',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '在监狱' => [
                        'title' => '死刑',
                        'body' => '
<p>亨利权臣、教会改革派托马斯·克伦威尔数次敦促 More 宣誓，家人和朋友也进狱劝说，但都遭到拒绝。<<wiki-more>><<stmomaha>> </p>
<p>在 15 个月的囚禁中，More 写了几部作品，包括 A Dialogue of Comfort Against Tribulation, A Treatise on the Passion, and The Sadness of Christ。莫尔一开始写《耶稣受难史》，但写到圣餐制的设立时，由于狱中没有精确的参考资料而辍笔。转而另写一部著作A Dialogue of Comfort Against Tribulation，即《快乐对苦难对话录》，书中点缀着不少圣经的训诫和幽默的趣闻轶事，其中有些情节带有自传性质。莫尔在狱中的作品，后人统称为「塔中书」。</p>
<p>1535 年 7 月 1 日，由新王后三位亲戚参与的法官小组对 More 进行审判，指控他否认国王至尊，犯有叛国罪。More 沉默以对，根据「qui tacet consentire videtur」，沉默等于承认国王的权威，More 不会被定罪，只要不明确否认国王是教会的首脑。但 Thomas Cromwell 指使人做伪证， 称 More 亲口否认国王是教会的合法首脑。只花了 15 分钟，陪审团便判决 More 有罪。<<wiki-more>></p>
<p>1535年7月6日，More 被执行死刑，他在断头台上说：「The King\'s good servant, but God\'s First.」。死后他的头被挂在伦敦桥上示众。 </p>
',
                        'display' => 'persons',
                        'start_date' => '1534-04-17',
                        'start_date_level' => 'dd',
                        'end_date' => '1535-07-06',
                        'end_date_level' => 'dd',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'tower',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                ],
            ],
            'Huang_Yu' => [
                'name' => '黄渝',
                'birthday' => '1964-07-14',
                'birthday_level' => 'dd',
                'deathday' => '2004-12-24',
                'deathday_level' => 'dd',
                'place_id' => 'yan_shan_tinghu',
                'place_intro' => '云南砚山',
                'family' => '父籍云南邱北，母籍重庆。',
                'missing' => '
                - 黄渝在砚山是六岁以前 具体时间？
                - 小学一年级是哪个学校？
                - 小学是五年吗？
                - 中学一共是五年吗？
                - 父母资料
                
                - 除了爸爸，妈妈是怎么带孩子的
                - 有什么特别的老师
                '
                ,
                'comment' => '逝世时间为纽约时间凌晨',
                '_experiences' => [
                    '小时候在砚山' => [
                        'title' => '和妈妈、哥哥、妹妹在一起生活',
                        'body' => '<p>在砚山县城出生<<father>>。母亲是重庆人，故取名「渝」<<lishangjing>>。</p>
<p>父亲在昆明工作，黄渝和哥哥、妹妹跟随母亲在砚山。母亲从事农业技术工作经常到乡村，有时带着三兄妹，乡间路上，青山、白云、野果，「母亲推着一辆车，他的妹妹坐在车里，他和哥哥在后边跟着走」，这个画面黄渝铭记一生<<father>><<zengsixin>>。</p>
<p>常照看他的保姆叫周阿姨；跟单位叔叔们去大水库钓鱼，每当钓得鱼时，他在旁边高兴<<father>>。</p>',
                        'display' => 'persons',
                        'start_date' => '1964-07-14',
                        'start_date_level' => 'dd',
                        'end_date' => '1969-01-01',
                        'end_date_level' => 'y',
                        'comment' => '黄渝在砚山是六岁以前，后到昆明跟随我',
                        '_places' => [[
                            '_place' => 'yan_shan',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '跟随爸爸到昆明' => [
                        'body' => '我到省第一“五七”干校他同我一起去了一年多；我到云南汽车厂造汽车，他和哥哥跟我到汽车厂 我上夜班他每天早上到厂大门口的钢管上等我下班。<<father>>',
                        'display' => 'normal',
                        'start_date' => '1969-01-01',
                        'start_date_level' => 'y',
                        'end_date' => '1971-09-01',
                        'end_date_level' => 'm',
                        'comment' => '',
                        '_places' => [
//                            [
//                                '_place' => '',
//                                'comment' => null,
//                            ],
                        ],
                    ], // _experience,
                    '小学一年级' => [
                        'body' => '
                        <p>星期天兄弟二人与城边村里的几个同学上山找柴火，搞点小树技背回家。哥哥患有小儿麻痹后遗症左腿走路困难，每次黄自己背柴火回家，让哥哥跟着走。</p>
<<father>>
',
                        'display' => 'normal',
                        'start_date' => '1971-09-01',
                        'start_date_level' => 'm',
                        'end_date' => '1972-06-01',
                        'end_date_level' => 'm',
                        '_places' => [
                            [
                                '_place' => 'yan_shan',
                                'comment' => null,
                            ],
                        ],
                    ], // _experience,
                    '小学、初中、高中' => [
                        'title' => '黄渝爱上数学，是从初二看一本《几何定理》开始的',
                        'display' => 'persons',
                        'body' => '',
                        'start_date' => '1972-09-01',
                        'start_date_level' => 'm',
                        'end_date' => '1981-07-01',
                        'end_date_level' => 'mm',
                        '_places' => [[
                            '_place' => 'kun_ming_mile',
                            'place_name' => '昆明',
                            'comment' => null,
                        ],],
                        '_children' => [

                            '在昆明上小学' => [
                                'body' => '
                            <p>1972年后，随妈妈到昆明上小学。爸爸发现，他回家从来没有把作业带回家来做的，他的哥哥妹妹回家后是做不完的作业，「老师讲完课，在课桌上就做完了」 。</p>
<p>小学四、五年级时，每天放学回家就看小说“西游记”、“水浒传”、“三国演义”、“岳飞传”、“杨家将”、“红旗飘飘”等，他一本一本的读完。一到星期天，院里的许多小同学在一起就听他讲小说里的故事。</p>
<p>父亲见黄渝自学能力强，天资聪明，感到课堂上教的不够他吃，就叫他向前学。</p>
<<father>>
',
                                'start_date' => '1972-09-01',
                                'start_date_level' => 'm',
                                'end_date' => '1976-06-01',
                                'end_date_level' => 'm',
                                '_places' => [
                                    [
                                        '_place' => 'mingtong_xiaoxue',
                                        'comment' => null,
                                    ],
                                    [
                                        '_place' => 'jingguo_xiaoxue',
                                        'old_name' => '靖国小学',
                                    ],
                                ],
                            ], // _experience,
                            '五年中学，初中昆明二十二中，高中师范附中' => [
                                'body' => '
                            <p>
                            黄渝爱上数学最后成了他终身追求，是从初二他看过一本许纯舫编的《几何定理》后开始的。中学五年，他读过的课外数学参考书一百余册，包括各地高考资料、中外竞赛试题等。考入高中时，已把中学数理化自学丛书全部学完了。
</p><p>
高中时作为学生代表分享心得：「简单的题要做，中等难度的题要做，而且要多做，在这个基础上再做一定难度的题」、「如果一味追求做难题，往往事倍功半，搞不好会使自己对数学逐渐不感兴趣。做题要一步一步的来（先易后难），正如数学家所说的『数学没有难与不难之分，只有熟与不熟之分，深入宅，熟悉了也就不难了』」
</p> <p>
1977 年底，全家挤在 16 平方米的小黑房子，长年靠20瓦的日光灯照明。妹妹在一张桌子的小角落做作业，黄和哥哥二人在缝衣机上，各人用一头。在昏暗的灯光下，他每天读书做习题都是夜间十一点休息，星期天从不出去玩，就在家里读书。那时，家里政治经济受歧视，他全部丢开，一心为了未来奋发读书。
</p><p>
1977 年高考恢复，同年黄看到科大少年班招生，但云南没有，请父去信询问，招生老师的回信让他失望，但也给了他鼓励。他说：如考取科大，就带着这封信去报到。 1981 年 7 月高考成功考入科大数学系。黄是当年高考的云南省第六名，他一心想学数学，填报中科大等五个志愿都是数学系。因黄物理考得99分与邹川民并列全省第一，科大招生老师动员他学近代物理，他喜欢数学，老师只好打电话到科大征求校里意见，最后校里同意把科大在云南招收数学专业仅有一个名额给了他。
</p>
<<father>>
',
                                'start_date' => '1976-09-01',
                                'start_date_level' => 'm',
                                'end_date' => '1981-07-01',
                                'start_date_level' => 'mm',
                                '_places' => [
                                    [
                                        '_place' => 'kun_ming_8_lang',
                                        'old_name' => '昆明二十二中',
                                    ],
                                    [
                                        '_place' => 'kun_ming_shi_shiyan',
                                        'old_name' => '昆明师院附中（84年后更名云南师大附中）',
                                        'comment' => '学校 2003 年搬迁至昆明市高新区洪源路，原址建立了一所新学校：云南师大实验中学。'
                                    ],
                                    [
                                        '_place' => 'kun_ming_mile',
                                        'comment' => null,
                                    ],
                                ],
                            ], // _experience,
                        ],// _children

                    ], // _experience,

                    '科大数学系' => [
                        'title' => '在数学中「吃、喝、玩、乐」',
                        'body' => '
<p>
在一、二年级时解决了一个关于矩阵的 open problem，许以超编的《代数学引论》上做了正定的情况，黄的一位学兄做了半正定的情况，黄做了所有不定的情况，「那段时间每天晚上开始算，算到深夜好象差不多了，但第二天早上一下就发现了问题，于是到了晚上又从头开始算，如此反复算了一个多月才最后成功。」<<zengsixin>>
</p>
                    <p>
他的作息习惯是夜里学习到两三点钟才悄悄回来睡觉，主要是「喜欢静，夜里没有干扰，脑子能高度集中，读过的书也记得牢」。（在安徽和北京上学时）一般寒假不回家，放暑假才回，白天晚上都读数学书，又喜夜间很静的时候读，每晚都看书看到深夜四、五点钟。<<father>><<tiantang>>
</p>
    <p>
他的毕业留言中，杨若勇同学说：「在我的记忆中，你大学的生活是这样的：吃苦在前，喝满墨水，玩遍矩阵，乐在其中。我想你一定会这样吃、喝、玩、乐一生」。<<father>>
</p>
',
                        'display' => 'person',
                        'start_date' => '1981-09-01',
                        'start_date_level' => 'm',
                        'end_date' => '1986-06-01',
                        'end_date_level' => 'm',
                        'comment' => '',
                        '_places' => [
                            [
                                '_place' => 'ke_da',
                                'comment' => null,
                            ],
                        ],
                        '_children' => [

                        ],// _children

                    ], // _experience,
                    '数学专业硕士研究生' => [
                        'title' => '通过一篇数学研究的心得取得了出囶学习的机会',
                        'body' => '师从曾肯成、许以超。1988年准备争取出囶继续学习。黄没有合格的英文托福成绩，通过一篇介绍多年数学研究心得体会的文章，获得两所大学的录取。1989年4月黄在家书中说：「<z-lang lang="en" title="约翰・霍普全斯大学数学系">The Department of Mathematics at Johns Hopkins University </z-lang>在数论、代数几何，拓朴学方面较强，有几个教授是世界一流的专家。」<<father>><<lishangjing>>',
                        'display' => 'person',
                        'start_date' => '1986-09-01',
                        'start_date_level' => 'm',
                        'end_date' => '1989-04-20',
                        'end_date_level' => 'dd',
                        '_places' => [
                            [
                                '_place' => 'guo_ke_da',
                                'old_name' => '中国科技大学研究生院（北京）',
                                'comment' => null,
                            ],
                        ],
                        '_children' => [

                        ],// _children

                    ], // _experience,
                    '读博' => [
                        'title' => '最喜爱 Hilbert 第 12 问题；论文课题「<z-lang title="朗兰兹纲领" lang="en">Langlands Program</z-lang>」',
                        'body' => '<p>在 Johns Hopkins University 读博，导师 Joseph Shalika，同时担任本科生和研究生的数学助教。在数学问题里，黄渝最喜爱 Hilbert 第 12 问题。黄在学校是有名的夜猫子，「每天半夜三更叼着根烟在校园里野走，谁要找他讨论问题只要半夜去数学系找就行了」。<<zengsixin>></p>
<p>黄渝的英文非常差，他的英文交流障碍一直困扰着他， 「不知让他受了多少罪」。<<zengsixin>></p>
<p>同学回忆在 Johns Hopkins 头几年的快乐时光：「黄渝能做菜是出了名的，对于我们这些单身特别有吸引力，我们有事没事都要去黄渝那里蹭饭。……那时晚上我们没事总是要到数学系去，黄渝总是在Common Room里高谈阔论，有一次说人生的意义，黄渝说人生的意义在于『智慧』。」<<zhuidaohui>></p>
<p>1991年12月家信中说「数学专业一般都是在学校教书，为找工作要拼命干」；1993年12月：「还是再等一年毕业。还是多做一点，才好找工作。在美囶每年毕业的数学博士有一千人左右，二百左右是中囶学生」。1994年，黄停止在校攻读学位。<<father>></p>',
                        'display' => 'person',
                        'start_date' => '1989-11-07',
                        'start_date_level' => 'dd',
                        'end_date' => '1994-04-01',
                        'end_date_level' => 'mm',
                        'comment' => '被签证问题耽搁，直到十一月四日才从北京赴纽约，见父回忆文章',
                        '_places' => [
                            [
                                '_place' => 'Hopkins',
                                'comment' => null,
                            ],
                        ],
                        '_children' => [

                        ],// _children

                    ], // _experience,
                    '94 年夏天回中囶，在美15年间唯一一次回囶' => [
                        'body' => '看望了亲人、老师、小时候在砚山的叔叔阿姨；到西双版纳、大理、丽江等地游玩了一趟；读了不少金庸小说。黄和父亲谈到博士论文：「凭我的感觉，还是可以搞下去的，只是需要时间。当然你说的万一搞不出来，也有这种可能，搞研究搞科研，有的人搞了一生就没有搞出，没有结果，这我知道。”」<<father>>',
                        'display' => 'normal',
                        'start_date' => '1994-05-13',
                        'start_date_level' => 'dd',
                        'end_date' => '1994-09-03',
                        'end_date_level' => 'dd',
                        '_places' => [
                            [
                                '_place' => 'kun_ming_mile',
                                'comment' => null,
                            ],
                        ],
                        '_children' => [

                        ],// _children

                    ], // _experience,

                    '离校后继续研究数学问题' => [
                        'title' => '通过打工维持生活',
                        'body' => '
                    <p>从中囶回到美囶后开始打工，家信中说：「找了一份临时工作，开车给人家送东西」<<father>>。 校内同学曾思欣回忆「当时他还住在学校附近，晚上在一个仓库扛东西，白天有时到学校听课。从那时起黄渝在经济上就一直生活在边缘，一贫如洗，到最后都没有翻身」<<zengsixin>></p>
                    <p>96 年 1 月家信：「本来我打算自己干着活，把论文做了再去申请学位。现在打算还是注着册，同时也干着活，这样同导师讨论的时间多些。」<<father>></li>
                    <p>96 年为接父母到美旅游，尝试“找点其他活干干，也可多挣两文收入”，97年5月因签证困难而作罢。<<father>></p>',
                        'display' => 'person',
                        'start_date' => '1994-09-01',
                        'start_date_level' => 'mm',
                        'end_date' => '2000-11-01',
                        'end_date_level' => 'mm',
                        '_places' => [
                            [
                                '_place' => 'Druid Lake',
                                'point_to' => '马里兰 巴尔的摩市',
                                'point_to_en' => 'Baltimore, MD',
                                'comment' => null,
                            ],
                        ],
                        '_children' => [

                        ],// _children

                    ], // _experience,
                    '一边谋生一边进行数学研究' => [
                        'title' => '「生活在边缘」',
                        'body' => '
<p>2000 年 12 月入职 Johns Hopkins 同学曾思欣工作的<z-lang lang="en" title="想象软件公司"> Imagine Software Inc. </z-lang> 从事商业软件开发，2001年7月被 layoff。其后的一年多无工作。<<zengsixin>></p>
<p>由朋友介绍，2002年9月开始在 CUNY 的 John Jay College 做 Tutor 从事数学答疑工作。大概从2003年初开始，凌晨为 Westfield Home News Service Inc.的顾客送报纸。黄在CUNY 遇到在 Johns Hopkins 认识的俄囶数论学家 Kolyvagin，开始每个星期四去听他的课。2003年3月和家通话时说「现跟老师做点工作，搞论文研究，在服务中心找点工作做维持生活。」<<father>><<zengsixin>><<newspapers>></p>
<p>朋友问他：「黄渝，你为什么总是生活在边缘？」黄渝说：「很多人生活在边缘啊。」 友：「可你并不deserve这个样呀。」黄渝默然不语。「别人经常为他着急，而他自己反而是漠然。」<<zengsixin>></p>
<p>2003 年，通过和曾思欣的交流，黄重新思考 Hilbert 第 12 问题，他用一个抽象的方法，主要是从函数域的 Drinfeld 模理论中得到了启发，关键要把函数的意义进行推广。到 04 年年底，黄说有一步仍然有问题，需要再研究。黄渝懒于笔墨，可能没有把自己的想法写下来。<<zengsixin>></p>
<p>2004 年 11 月 27 日，黄的车坏在了去钓鱼的路上，坐火车辗转回家。曾思欣认为他的老破车可能都不值得修了，打算过了年，好好劝黄渝不要再读Ph.D了，先在学校找一份稳定的技术工作，把生活安定下来。<<zengsixin>></p>
<p>2004 年 12 月 18 日，黄给家里打电话，询问父母、亲人的情况，谈到自己「研究继续搞着，每个星期去找导师讨论一下，有时导师讲课，就听课」。<<zengsixin>></p>
<p>2004 年 12 月 24 日，圣诞节前一天凌晨，黄投送报纸，在 22 号高速公路上汽车爆胎，下车检修时遭遇车祸。</p>
<p>为了心爱的数学，黄多次婉拒了父亲和众多同学介绍工作的好意，这可能就是好友曾思欣评价他「固执」的原因。<<father>><<lishangjing>><<liuyang>></p>
',
                        'display' => 'person',
                        'start_date' => '2000-12-01',
                        'start_date_level' => 'mm',
                        'end_date' => '2004-12-24',
                        'end_date_level' => 'dd',
                        '_places' => [
                            [
                                '_place' => 'New York Bay',
                                'point_to' => '纽约都会区',
                                'point_to_en' => 'Greater New York',
                                'comment' => null,
                            ],
                            [
                                '_place' => 'Imagine',
                                'comment' => null,
                            ],
                            [
                                '_place' => 'John',
                                'comment' => null,
                            ],
                        ],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                ], // _experiences,
            ],// Huang_Yu


            'F' => [
                'name' => 'Richard Feynman',
                'birthday' => '1918-05-11',
                'birthday_level' => 'dd',
                'deathday' => '1988-02-15',
                'deathday_level' => 'dd',
                'place_id' => 'Brooklyn',
                'place_intro' => '',
                'family' => '',
                'missing' => '
                '
                ,
                'comment' => '',
                '_experiences' => [
                    '幼年' => [
                        'title' => 'Feynman 是个迟语儿( late talker )，<z-lang title="From his mother he gained the sense of humor ">从母亲习得了幽默感</z-lang>',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1918-05-11',
                        'start_date_level' => 'dd',
                        'end_date' => '1928-05-12',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Brooklyn',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,

                    '小学、初中' => [
                        'title' => '',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1923-09-01',
                        'start_date_level' => 'm',
                        'end_date' => '1931-07-01',
                        'end_date_level' => 'm',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Far_Rockaway',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '高中' => [
                        'title' => '',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1931-09-01',
                        'start_date_level' => 'm',
                        'end_date' => '1935-07-01',
                        'end_date_level' => 'm',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Far_Rockaway_High_School',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '大学' => [
                        'title' => '',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1935-11-01',
                        'start_date_level' => 'm',
                        'end_date' => '1939-07-01',
                        'end_date_level' => 'm',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'MIT',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '读研' => [
                        'title' => '',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1939-07-12',
                        'start_date_level' => 'm',
                        'end_date' => '1942-06-16',
                        'end_date_level' => 'dd',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '普林斯顿大学',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '原子弹' => [
                        'title' => '',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1939-07-12',
                        'start_date_level' => 'm',
                        'end_date' => '1942-06-16',
                        'end_date_level' => 'dd',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Los_Alamos',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    'Cornell' => [
                        'title' => '',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1945-01-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1951-01-01',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => 'Cornell',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                    '加州理工学院' => [
                        'title' => '',
                        'body' => '',
                        'display' => 'persons',
                        'start_date' => '1945-01-01',
                        'start_date_level' => 'yy',
                        'end_date' => '1988-02-15',
                        'end_date_level' => 'yy',
                        'comment' => '',
                        '_places' => [[
                            '_place' => '加州理工学院',
                        ],],
                        '_children' => [
                        ],// _children

                    ], // _experience,
                ] // _experiences,
            ], // a person end  F
        ];


        $this->addRefs($refs);

        foreach ($persons as $_PersonSlug => $person) {
            $_experiences = $person['_experiences'];
            unset($person['_experiences']);

            $person['place_id'] = $placeIDs[$person['place_id']];

            $person['family'] = $this->parseRefTag($_PersonSlug, $person['family']);
            $person['comment'] = $this->parseRefTag($_PersonSlug, $person['comment']);
            $personID = DB::table('persons')->insertGetId($person);

            $this->addExperiences($_experiences, $personID, $_PersonSlug, null);

        }


    }


    function addTags()
    {
        $tags = [
            'Person' => [
                'Thomas_More' => [
                    '基督教' => ['intro' => '', 'level' => '1', 'type' => '信'],
                    '幽默' => ['intro' => '', 'level' => '1', 'type' => '喜'],
                    '阅读' => ['intro' => '古典、人文', 'level' => '1', 'type' => '爱'],
                    '翻译' => ['intro' => '', 'level' => '1', 'type' => '为'],
                    '写作' => ['intro' => '', 'level' => '1', 'type' => '为'],
                    '公知' => ['intro' => '', 'level' => '2', 'type' => '担'],
                    '官员' => ['intro' => '', 'level' => '2', 'type' => '担'],
                    '法官' => ['intro' => '', 'level' => '2', 'type' => '担'],
                    '律师' => ['intro' => '', 'level' => '2', 'type' => '担'],

                ],
                'Huang_Yu' => [
                    '数学' => ['intro' => '', 'level' => '1', 'type' => '爱'],
                    '和善' => ['intro' => '', 'level' => '1', 'type' => '性'],
                    '阅读' => ['intro' => '', 'level' => '2', 'type' => '喜'],
                    '留美华人' => ['intro' => '', 'level' => '2', 'type' => ''],
                    '钓鱼' => ['intro' => '', 'level' => '3', 'type' => '喜'],

                ],
            ],
        ];
    }

    function parseRefTag($personSlug, $str)
    {
        return preg_replace_callback(
            '|<<([-\w]+)(?::(\d+))?>>|',
            function ($matches) use ($personSlug) {
                if (isset($this->referenceIDs[$personSlug][$matches[1]])) {
                    echo $matches[0], PHP_EOL;
                    $ref = $this->referenceIDs[$personSlug][$matches[1]];
                    if (isset($matches[2])) {
                        return "<sup>$ref</sup><sup>:${matches[2]}</sup>";
                    } else {
                        return "<sup>$ref</sup>";
                    }
                } else {
                    echo 'parseRefTag ', $matches[0], ' not found', PHP_EOL;
                    return $matches[0];
                }
            },
            $str
        );

    }

    function addRefs($all_items)
    {

        DB::table('references')->truncate();

        $articleOrPersonIDs = require __DIR__ . '/person_ID.php';

        $referenceIDs = [];

        foreach ($all_items as $personSlug => $items) {

            foreach ($items as $refSlug => $item) {

                $_referenceable_type = $item['_referenceable_type'] ?? ['Person',];
                unset($item['_referenceable_type']);

                $this->encodeFieldsIndependently($item, "$personSlug _ $refSlug", ['title', 'intro', 'author']);
//            $this->encodeBody($item, "$personSlug _ $refSlug", false);


                foreach ($_referenceable_type as $referenceable_type => $attris) {

                    if (is_numeric($referenceable_type)) {
                        $referenceable_type = $attris;
                        $attris = null;
                    }

                    if (substr($referenceable_type, 3) != 'App') {
                        $referenceable_type = 'App\\' . $referenceable_type;
                    }

//                    $type = $attris['type']??null;
                    $order = $attris['_order']??null;

//                    if (($type == 'suggest' && $order > 100) || ($type == 'link' && $order < 100) || $order > 255) {
//                        throw  new \Exception('wrong order for ' . $item['title']);
//                    }

                    $item['referenceable_type'] = $referenceable_type;
                    $item['referenceable_id'] = $articleOrPersonIDs[$personSlug];
                    $item['order'] = $order;


                    $referenceID = DB::table('references')->insertGetId($item);

                    if ($referenceable_type == 'App\Person') {
                        $referenceIDs[$personSlug] = $referenceIDs[$personSlug] ?? [];
                        $referenceIDs[$personSlug][$refSlug] = $referenceID;
                    }

                }
            }
        }

        var_dump($referenceIDs);
        $this->referenceIDs = $referenceIDs;


    }


    function addExperiences($_experiences, $personId, $_PersonSlug, $pid = null)
    {

        foreach ($_experiences as $intro => $experience) {

            if (!$experience) {
                continue;
            }

            $experience['intro'] = $intro;
            echo $experience['intro'], PHP_EOL;

            $_places = $experience['_places'];
            $_children = $experience['_children']??[];
            unset($experience['_children'], $experience['_places']);

            if ($pid) {
                $experience['pid'] = $pid;
            } else {
                $experience['pid'] = $_children ? 0 : null;
            }

            $experience['person_id'] = $personId;


            $experience['body'] = $this->parseRefTag($_PersonSlug, $experience['body']);
            $experienceID = DB::table('experiences')->insertGetId($experience);

            foreach ($_places as $_place) {

                $place_slug = $_place['_place'];
                echo "\t$place_slug\n";


                $new_place_id = $this->insertPointOrOldPlace($_place,$place_slug);

                $data = [
                    'placeable_type' =>'App\\Experience',
                    'placeable_id' => $experienceID,
                    'place_id' => $new_place_id ?: $this->placeIDs[$place_slug],
                    'place_name' =>$_place['place_name']??null,
                    'comment' =>$_place['comment']??null,
                ];

                if (isset($this->placeIDs[$place_slug])) {
                    DB::table('placeables')->insert($data);
                } else {
                    echo "$_place not set isset in \$this->placeIDs])";
                }
            }
            echo "\n";

            $this->addExperiences($_children, $personId, $_PersonSlug, $experienceID);

        }
    }

    // 过去的老地名，还有标志性地名，都存入 places
    function insertPointOrOldPlace($_place, $place_slug)
    {
        $new_place_id = null;

        if ($_place['old_name']??null) {

            $new_place = array_merge($this->places[$place_slug], [
                'name' => $_place['old_name'],
                'type' => 'old',
                'relate_id' => $this->placeIDs[$place_slug],
            ]);
            $new_place_id = DB::table('places')->insertGetId($new_place);

        } elseif ($_place['point_to']??null) {

            $new_place = array_merge($this->places[$place_slug], [
                'type' => 'point',
                'name' => $_place['point_to'],
                'name_en' => $_place['point_to_en']??null,
            ]);
            $new_place_id = DB::table('places')->insertGetId($new_place);

        }

        return $new_place_id;
    }

}
