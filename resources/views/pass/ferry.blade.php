@extends('layouts.base')

@section('content')
    <div class="container make-footer-margin-top-smaller">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="first-page" id="which-first-page">
                    <style>
                        @include('css.ferry')
                        /*# sourceURL=ferry.css */
                        /*# sourceMappingURL=/css/map/ferry.css.map */
</style>
                    <div id="which-loading">
                        <div class="inner"></div>
                        <div class="inner"></div>
                        <div class="inner"></div>
                        <div class="inner"></div>
                    </div>
                    <h1 class="first-title text-center">渡万壑千岩，越溪深处</h1>
                    <div id="which">
                        <div id="which-lu-box">
                        <blockquote class="which-lu">
                            <p></p>
                            <footer></footer>
                            <div class="heart">❤</div>
                        </blockquote>
                        <blockquote class="which-lu">
                            <p></p>
                            <footer></footer>
                            <div class="heart">❤</div>
                        </blockquote>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection

@section('script_b')
    <script>

        var quotes1 = [
                [
                    {
                        c: '给孩子报了五个兴趣班，如果孩子不愿意去必定就是一顿打，“养不教父之过”，多为孩子将来着想没有错。孩子年纪小自控能力差，家长就要帮助做好规矩养成好习惯。',
                        f: '一位“虎妈”',
                    },
                    {
                        c: '好奇是人的天性，责任感也是。学习需要兴趣和责任感，这两样东西孩子都有，只要不被破坏。一位家长说「你已经欠数学老师三次作业了」。她在告诉孩子，作业是别人的事，不是你的。在这样的语境下成长，孩子怎能对学习有正常心理呢？',
                        f: '尹建莉',
                        z: 1
                    }
                ],
                [
                    {
                        c: '我们一直很注意在各方面鼓励圆圆，但只给她精神鼓励，几乎没动用过物质奖励。在学习上更是执行“不奖励”政策。她考好考坏都是正常的，不会因为她考好了我们就兴高采烈，考不好就生气失望。',
                        f: '尹建莉',
                        z: 1
                    },
                    {
                        c: '一位妈妈奖励孩子学习：「数学考95分以上，出去旅游，语文考95分以上，同意买小狗，两门都在95分以上，奖励自由支配基金800元，两门在90分以上，可以自由选择上兴趣班。」',
                        f: '扬州晚报',
                    }
                ],

                [
                    {
                        c: '大家痛恨的是别人腐败，并不是腐败 ',
                        f: '网络',
                    },
                    {
                        c: 'The Constitution is the guide which I never will abandon.',
                        f: 'George Washington',
                        z: 1
                    }
                ],

                [
                    {
                        c: '“财富代表了一个人的社会地位，也是一个人成功的标志，只要努力做事，勤奋工作，就有机会购买几百元的别墅名车，过上精英日子，娶上大家闺秀或名门千金。”',
                        f: '家长带孩子参观豪华别墅并积极教导',
                    },
                    {
                        c: '一位教授说，如果你们来这里，只是为了找份工作，赚很多钱，那你们就走错地方了。四年后发现，这世界上真的有比找一份铁饭碗、赚很多钱更有意义的追求。',
                        f: 'xiaoxiaom@twitter',
                        z: 1
                    },
                ],
                [
                    {
                        c: '昨天又和我歪歪，气得我训了她一顿，说你从小到大犯了不知多少错误，大家都能原谅你，你怎么一点小事都不能原谅别人？',
                        f: '<a class="color-inherit" href="//blog.sina.com.cn/s/blog_54377c2a0102wov4.html">孩子为何不宽容不感恩？</a>',
                    },
                    {
                        c: '用“表现好”或“表现不好”来评价孩子是一种陋习，这样会引导孩子看重表现，在意表现，习惯表现，活得谨小慎微且不真实，终极恶果是不会和自己相处。教师及家长都应该戒掉这个习惯。 ',
                        f: '尹建莉',
                        z: 1
                    },

                ],
            ],

            quotes2 = [
                [
                    {
                        c: '我们干事情，不是因为确信在很短的时间内能够直接看到成功的可能，而仅仅因为这是件好事，所以我们就应去做。',
                        f: '《哈维尔文集》',
                        z: 1
                    },
                    {
                        c: '(三峡工程)国家决定修的，就是持反对也没有用，只能积极地出谋献策…这是我们作为一个科技人员的良知…',
                        f: '中国工程院院士卢耀如',
                    }
                ],
                [
                    {
                        c: '「生而平等的价值观已经渗透到西方人的骨子里」，在餐馆对服务生大声呵斥的基本都是中囶人，「加拿大人很诧异」。状元博士只找到一份体力工，跳楼自杀。移民华人马舒觉得是教育害的，「尊卑贵贱意识」。',
                        f: '2011年的《南方周末》',
                        z: 1
                    },
                    {
                        c: '广州一小区清洁工劝说三名溜狗女子清理狗粪便，遭到辱骂。狗主用棍子指着清洁工大声叱骂清洁工：“你们命还不如狗命值钱。”',
                        f: '中国青年网'
                    }
                ],
                [
                    {
                        c: '我责问村长，「你知道那些假药会害死人吗？你还有点道德吗？」村长指着身后一排整齐而高耸的民房，中气十足地说，「我最大的道德就是让我的乡亲们富起来。」',
                        f: '吴晓波',
                    },
                    {
                        c: '孙焕平，贩过鸡、卖过豆芽、开过餐馆……一旦熟知了其中的潜规则，他便改行，「我不能这样做，良心过不去」',
                        f: '《法治周末》',
                        z: 1
                    }
                ],
                [
                    {
                        c: '在我决定将这些知识传递到我的村庄时，我的心里第一次有了一种作为未来科学家的使命感。但这种使命感不只停在知识层面，它也是我个人道德发展的重要转折点，我自我理解的作为国际社会一员的责任感。',
                        f: '何江',
                        z: 1
                    },
                    {
                        c: '努力向中产跨越，年收入100万，越快越好。等完成了物质积累，学成功人士打高尔夫，带妻儿出国去巴厘岛、马尔代夫。只有物质方面达到了，才有精神方面的追求。',
                        f: '何江的一位初中同学',
                    }
                ],
                [
                    {
                        c: '“打工皇帝”唐骏回应履历造假：「如果把全世界都蒙了，就是你的真诚蒙到了别人。所有人都被你欺骗到了，就是一种能力，就是成功的标志。从头到尾我都是一个真诚的人！」',
                        f: '《中国青年报》',
                    },
                    {
                        c: '多年前的南非：有一次庭审曼德拉之前，公诉人Bosch突然撂摊子不干了，他跑过去跟曼德拉握手，说：我鄙视我所做的事情，我不想把你给送到监狱里去。',
                        f: '《曼德拉自传》',
                        z: 1
                    }
                ],
            ];

        var selectLu = {
            ui: null,
            two_block:null,
            z: null,// 现在是哪个元素为真
            autoClickWaitTime: 1000 * 60,
            autoTimerID: null,
            data: [],
            target: 1125,  // 要完成的数量
            finished: 0,//  已完成的数量
            waitingForClicking: false,
            init: function () {
                this.ui = $('#which-lu-box');
                this.two_block= $('.which-lu',this.ui);
                this.two_block.on('click', selectLu.clickHandler)
                $('body').css({'overflow-x': 'hidden'})
                this.makeData().reset();
                return this;
            },
            makeData: function () {
                this.shuffle(quotes1);
                this.shuffle(quotes2);
                this.data = quotes1.concat(quotes2);
                return this;
            },
            // http://stackoverflow.com/questions/2450954/how-to-randomize-shuffle-a-javascript-array  author:cocco
            shuffle: function (a, b, c, d) {
                c = a.length;
                while (c) b = Math.random() * (--c + 1) | 0, d = a[c], a[c] = a[b], a[b] = d
            },
            exit: function () {
                location.href = '/' + 'pass';
            },
            loadDataAndShow: function () {
                if (this.finished >= this.target) {
                    this.exit();
                    return;
                }

                var data = this.getOneData(), randomIndex = Math.random() > 0.5 ? 1 : 0;
                var data0 = data[randomIndex],
                    data1 = data[1 - randomIndex];

                this.two_block.eq(0).data('quote', data0.z).children('p').text(data0.c).next().html(data0.f);
                this.two_block.eq(1).data('quote', data1.z).children('p').text(data1.c).next().html(data1.f);
                this.z =selectLu.two_block.eq( data0['z'] ? 0 : 1);

                this.ui.animate({
                    right: 0,
                }, 2500, function () {
                    console && console.log('show finished');
                    selectLu.autoTimerID =
                        setTimeout(function () {
                            selectLu.go(selectLu.z);
                        }, selectLu.autoClickWaitTime)
                });


            },
            reset: function () {
                this.z=null;
                this.two_block.removeData().removeClass('active');
                this.two_block.css({
                    opacity: 1
                });
                this.ui.css({
                    right: '200%',
                });
                this.waitingForClicking = true;
                return this;
            },
            clickHandler: function () {
                selectLu.go(this);
            },
            go: function (zElement) {
                if (!$(zElement).data('quote') || !selectLu.waitingForClicking)
                    return;

                clearTimeout(selectLu.autoTimerID);
                selectLu.waitingForClicking = false;
                selectLu.finished++;
                $(zElement).addClass('active').siblings('blockquote').css({opacity: 0.05});
                selectLu.ui.delay(900)
                    .animate({
                        right: '-200%',
                    }, 2500, function () {
                        selectLu.reset().loadDataAndShow();
                    });
            },
            getOneData: function () {
                if (this.data.length == 0)
                    this.makeData();

                return this.data.pop();
            }

        };
        selectLu.init().loadDataAndShow();

    </script>
@endsection
