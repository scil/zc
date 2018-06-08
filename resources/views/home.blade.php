@extends('layouts.base',['title'=>'真城','desc'=>'真之城，致敬真，致敬理想主义！'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <style>
                    #home-first-page {
                        padding: 50px 35px;
                    }

                    #first-page-quote {
                        padding: 0.9% 0;
                    }

                    .map {
                        position: relative;
                    }

                    .mapTooltip {
                        position: absolute;
                        background-color: #474c4b;
                        moz-opacity: 0.70;
                        opacity: 0.70;
                        filter: alpha(opacity=70);
                        border-radius: 10px;
                        padding: 10px;
                        z-index: 1000;
                        max-width: 260px;
                        display: none;
                        color: #fff;
                    }
                </style>
                <div class="first-page" id="home-first-page">
                    <div id="first-page-quote" class="text-center">
                        {{--在T1的QQ上打开　圆角不正常　Q浏览器X5内核　, 需要：在img 外面嵌套一个元素并设置border 和border-radius--}}
                        {{--参考　http://www.tuicool.com/articles/vQZnMjv--}}
                        {{--<img class="quote-img" src="//cdn.shopify.com/s/files/1/0691/5403/t/108/assets/avatar-dhg.png?744977531054780914">--}}
                        <div class="quote-img">
                            <img src='/img/org/road.jpg'>
                        </div>

                        <div class="quote-text">
                            <div>
                                <p>一个孩子，他内心自信平和，比谨小慎微重要；凡事有好奇心，比凡事不出错重要；他有自我选择的勇气，比选择正确重要。</p>
                                {{--<p>「天生万物人为贵」</p>--}}
                            </div>
                        </div>
                        <a href="/human/nature/childhood-needs-trial-error-disobedience"
                        {{--<a href="/human/road/great-zouzhe-China"--}}
                           class="pure-kaiti quote-src btn btn-warning btn-primary-outline btn-sm">
                            童年需要“试误”和“不听话”
                            {{--中囶历史上的伟大奏折--}}
                        </a>

                    </div>
                    <div id="first-page-map">
                        <div class="map"></div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    @include('partials.columns._home-body')

    <div class="container columns text-center heiti" id="zc-map">
        <h2 class="h2title">真城地图
        </h2>

        <div class="row">
            @include('partials.columns._map')
        </div>
    </div>

@stop

@section('script_b')
    <script>
        zc.content._bigHref();

        var slide = $('#home-first-page').slick({
            initialSlide: 0,
            autoplay: false,
            autoplaySpeed: 25000,
            arrows: false,
            mobileFirst: false,
            adaptiveHeight: true,
            draggable: false,
        });

        var slideTimer = null;

        function slideGo(index) {
            if (slideTimer) {
                clearTimeout(slideTimer)
            }
            slideTimer = setTimeout(function () {
                slide.slick('slickGoTo', index);
            }, 80)
        }

        $('#header-row').mouseenter(function () {
            slideGo(0);
        }).click(function () {
            slideGo(0);
        });

        var IDs = {!! json_encode($IDs) !!};
        var plots = {!! json_encode($plots) !!};

        var lastPlotsGroup = '';

        zcmap = new ZCMap(
            {
                ele: $("#first-page-map"),
                plotsIDs: [],
                plots: [],
                mode: 'all',
                direction: 'ltr',
                config: {
                    plotSize: 15,
                },// plotColor:'#8800CC'},
                mouseoverCallback: (e, id, mapElem, textElem, elemOptions) => {
                }
            },
            null
        );

        function showPlotsForLi(li, visit) {

            slideGo(1);

            var url = li.firstChild.getAttribute('href');
            if (url === lastPlotsGroup) {
                if (!visit) return;

                location.href = url;
                return;
            }
            lastPlotsGroup = url;
            $(li).parent().addClass('active').siblings().removeClass('active');
            zcmap.resetDataAndShow({
                plotsIDs: IDs[lastPlotsGroup],
                plots: plots[lastPlotsGroup],

            });
        }

        $('#header-nav li').mouseenter(function (e) {
            showPlotsForLi(this, false);
            return false;
        });
        if ('ontouchstart' in document) {

            $('#header-nav a')
               .on('touchstart click', function (e) {

                    // var a_link = $(this);
                    // if (a_link.data('flag') === 1) return false;
                    //
                    // a_link.data('flag', 1);
                    // setTimeout(function () {
                    //     a_link.data('flag', 0);
                    // }, 100);

                    showPlotsForLi(this.parentElement, true);
                    return false;
                });
        }
        //# sourceURL=zc_home_map
    </script>
    <script src="https://cdn.bootcss.com/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <script>

        // 宽屏上3个以上的子栏目是隐藏的 鼠标滚动显示 一个大栏目最多支持6个子栏目
        !function () {
            var ele = $('.row-more-cols');

            if(!ele.mousewheel) return;

            if (ele.length == 0) return;

            var bIsWorking = false;
            scrollColumns = function (ele) {
                // 通过 media query 的 css 提供的 z-index 来判断是否需要滚动 ，手机小屏不需要滚动
                if (ele.css('opacity') != '0.99') return;

                if (bIsWorking) return;

                var $c = ele.children();

                if (ele.css('right') == '0px') {
                    // 开始显示隐藏的栏目
                    bIsWorking = true;
                    var len = $c.length, $left = $($c[len - 3].firstElementChild),
                        $mid = $($c[len - 2].firstElementChild),
                        $right = $($c[len - 1].firstElementChild)

                    $('.more-col', ele).animate({
                        'opacity': 0.99
                    }, 3000, function () {
                        bIsWorking = false;
                    });
                    ele.animate({
                        'right': len == 4 ? '33.3333333333%' : '66.66666%'
                    }, 3000);

                    $left.removeClass('column-right').addClass('column-left')
                    $mid.removeClass('column-right')
                    $right.addClass('column-right')
                } else {
                    // 回去
                    bIsWorking = true;

                    $mid = $($c[1].firstElementChild),
                        $right = $($c[2].firstElementChild)

                    $('.more-col', ele).animate({
                        'opacity': 0.1
                    }, 2500, function () {
                        bIsWorking = false;
                    });
                    ele.animate({
                        'right': 0
                    }, 2500);

                    $mid.removeClass('column-left')
                    $right.addClass('column-right')
                }
            }

            ele.mousewheel(function (e) {
                e.stopPropagation();
                e.preventDefault();
                scrollColumns($(this));
            });

        }();

        //# sourceURL=zc_home
    </script>
@stop
