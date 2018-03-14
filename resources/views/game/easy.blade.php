@extends('layouts.columns._game_easy')


@section('content')

    <div class="container">
        <div class="row">


            <div class="col-xs-12">

                <h1 id="first-page-column-title">
                    <div src="/img/org/sit.png" id="first-page-column-img"
                         style="position: relative;margin-right:13px;">
                        <div id="sit-img">

                        </div>
                    </div>
                    <style>
                        #sit-img {
                            width: 55px;
                            height: 55px;
                            background-image: url(/img/org/sit.jpg);
                            background-size: cover;
                            position: absolute;
                            bottom: 0;
                        }

                        #sit-img.no-sit {
                            width: 55px;
                            height: 82.5px;
                            margin-top: -14px;
                            background-image: url(/img/org/stand.png);
                        }
                    </style>
                    {{--<img src="/img/org/imagine.png" class="side-img" id="imagine-side-img">--}}
                    坐下来
                </h1>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-5 col-lg-push-7 col-sm-6 col-sm-push-6 col-xs-12">
                <div id="intro-first-page-side">

                    {{--<div class="well-on-lightblue well-with-slides zc-slides" id="imagine-quotes">--}}
                    <div class="zc-slides" id="sit-quotes">

                        <div sit="1">
                            <p>
                                我老公觉得有必要确立自己在儿子面前的权威，但儿子并不听他的，他能吓住孩子，使孩子就范，但并没有在孩子那里得到他想要的威信。一天他对我说，孩子现在听你的，你应该要求他……，我问儿子：你最听妈妈的话，是这样的吗？儿子点了点头。
                            </p>

                            <p>
                                我说：可是妈妈并不要求你听我的啊 ，我不会要求你以我为正确，这个世界上，没有任何一个人可以要求你听从他。你会有自己的判断，并能用你的智慧平衡自己与他人，自己与社会的关系。
                            </p>

                            <div class="text-right">
                                —— <a class="color-inherit"
                                      href=""></a>
                            </div>
                        </div>
                        <div sit="0">
                            <p>

                            </p>

                            <p>

                            </p>

                            <div class="text-right">
                                —— <a class="color-inherit"
                                      href="//weibo.com/p/23041854377c2a0102wov5"></a>
                            </div>
                        </div>
                        <div sit="1">
                            <p>
                            </p>

                            <div class="text-right">
                                —— <a class="color-inherit"
                                      href="">“不陪”才能培养好习惯</a>
                            </div>
                        </div>
                        <div sit="0">
                            <p>
                                在公园一小女孩奶奶抓过正在玩耍的娃，说给这个阿姨背个唐诗！小女孩极度不乐意，奶奶威胁说，你不背诗我不跟你好了！
                            </p>

                            <p>
                                在佛塔旁边溜达时，无意中看见一个爸爸硬逼着一个貌似不到十岁的小女孩在佛塔前背诵佛经，背不出就是一顿责骂，接着是女孩的啜泣。如果真的有佛，那他就不应该坐在那里接受那些疯子的膜拜，而是应该帮帮这样的孩子，给他们应有的童年。
                            </p>

                            <div class="text-right">
                                ——
                                <a class="color-inherit" href="//weibo.com/2000236341/zx6zV9AIS">大咪和小坏</a>
                                <a class="color-inherit" href="//weibo.com/2389210250/zmv5blSp7">石惠民</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-lg-pull-5 col-sm-6 col-sm-pull-6 col-xs-12 ">
                <div id="intro-first-page" class="">

                    <p>
                        “一个小孩偷玩注射器，不小心扎到眼球，不敢与父母讲。不明原因的家长自行滴眼药水处理；再不久角膜穿孔眼球化脓，不得不摘掉眼球。没有更好的办法？是的，医学解决不了的事情还很多。平时别过多责怪孩子，让他什么都敢对你讲。”（<a
                                class="color-inherit" href="//weibo.com/2399301482/CpvA92RNL
">医生欧茜</a>）</p>

                    <p>
                        分辨教育的一个简单方法，就是看孩子“闯祸”时，譬如打碎了一个杯子，孩子内心是心疼杯子还是害怕批评。轻松自由的环境有利于孩子的自然成长，但现实中，害怕娇惯孩子、急功近利的心理却成为魔咒，让很多家长把严苛和规矩放到了错误位置。</p>

                    <p>
                        孩子有自己的世界和法则。大人们不妨改变自己，坐下来从孩子的角度去思考；坐下来陪伴孩子，做孩子的朋友，呵护孩子的内生力；坐下来好好做自己，做孩子的榜样，也给孩子留出自由的空间。
                    </p>

                    <p>
                        “坐下来”这个游戏，就是请大家利用身边机会，传播一些相信孩子、尊重孩子的理念、资料。欢迎大家把自己的经历、经验分享一下，互相交流，也许会很有意思。
                    </p>
                </div>
            </div>
        </div>

    </div>



    <div class="container">
        <div class="row">
            <div class="col-md-7 first-page-below">
                {{--<div class="col-md-8 col-sm-10 first-page-below last-page-before">--}}

                <hr class="first-page-below-hr">

                <div class="list-items-bar clearfix">
                    <button type="button" class="btn btn-warning pull-right" id="imagine-btn">分享一下</button>
                </div>

                <div class="one-sit">

                    <div class="sit-head clearfix">
                        <div class="list-item-title pull-left">
                            火车上妈妈教孩子学成语

                        </div>
                    </div>
                    <div class="list-item-body">
                        随机文本
                        aa任何使用落网的行为都必须符合以下条件：

                        1、所有的对音乐、图像、文字和其他内容的搜索、下载与播放均以个人合理使用为目的；

                        2、所有的对音乐、图像、文字和其他内容的影视和图像的搜索、下载与播放均不得用于商业目的；

                        根据中国相关法律.法规和规范性文件要求，落网的软件提供者制定了旨在保护知识产权权利人合法权益的措施和步骤，当权利人发现通过落网的内容侵犯其权利时，权利人应事先向落网发出书面的“权利通知”，落网将根据中国法律法规和政府规范性文件采取措施移除相关内容或相关链接。a
                    </div>
                    <div class="list-item-foot">

                        <span class="foot-author">张大侠</span>
                        <span class="foot-time">2015-06 更新</span>
                        <span class="toggle-message"><i class="icon-comment"></i>留言</span>
                        <span class="toggle-message"><i class="icon-heart-empty"></i>谢谢分享</span>

                    </div>

                </div>

                <hr class="imagine-hr">

                <div class="one-sit">
                    <div class="sit-head clearfix">
                        <div class="list-item-title pull-left">
                            推荐书

                        </div>
                        <div class="sit-vote pull-right">

                        </div>
                    </div>
                    <div class="list-item-body">
                        随机文本
                        aa任何使用落网的行为都必须符合以下条件：

                        1、所有的对音乐、图像、文字和其他内容的搜索、下载与播放均以个人合理使用为目的；

                        2、所有的对音乐、图像、文字和其他内容的影视和图像的搜索、下载与播放均不得用于商业目的；

                        根据中国相关法律.法规和规范性文件要求，落网的软件提供者制定了旨在保护知识产权权利人合法权益的措施和步骤，当权利人发现通过落网的内容侵犯其权利时，权利人应事先向落网发出书面的“权利通知”，落网将根据中国法律法规和政府规范性文件采取措施移除相关内容或相关链接。a
                    </div>
                    <div class="list-item-foot">

                        <span class="foot-author">张大侠</span>
                        <span class="foot-time">2015-06 更新</span>
                        <span class="toggle-message"><i class="icon-comment"></i>留言</span>
                        <span class="toggle-message"><i class="icon-heart-empty"></i>谢谢分享</span>
                    </div>

                </div>

            </div>

        </div>
    </div>

@stop

@section('script_b')
    <script>
        $('#sit-quotes').slick({
            autoplay: true,
            autoplaySpeed: 35000,
            arrows: false,
            mobileFirst: false,
        });
        $('#sit-quotes').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            $ele = $(slick.$slides[nextSlide]).eq(0);
            if ($ele.attr('sit') == '1') {
                $('#sit-img').removeClass('no-sit');
                console.log('sit');
            } else {
                $('#sit-img').addClass('no-sit');
                console.log('stand');
            }
        });
    </script>
@stop
