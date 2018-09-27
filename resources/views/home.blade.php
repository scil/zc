@extends('layouts.base'.$IS_PJAX,['title'=>'真城','desc'=>'真城，致敬真，致敬理想主义！'])

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

                    #first-page-space {
                        padding-top: 9%;
                    }

                    #first-page-map {
                        padding: 0 6%;
                        margin-bottom: -15px;
                    }

                    @media (min-width: 1200px) {
                        #first-page-space {
                            padding-top: 7%;
                        }

                        #first-page-map {
                            padding: 0 12%;
                        }

                    }

                    @media (max-width: 768px) {
                        #home-first-page {
                            padding: 50px 15px;
                        }

                        #first-page-space {
                            padding-top: 10%;
                        }

                        #first-page-map {
                            padding: 0;
                        }

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
                        {{-- border-radius Android BUG --}}
                        <div class="quote-img">
                            <img src='/img/org/qing.jpg'>
                        </div>
                        <div class="quote-text">
                            <div>
                                <p>{!! $articles[$articleID]['desc'] !!}</p>
                                {{--<p>一个孩子，他内心自信平和，比谨小慎微重要；凡事有好奇心，比凡事不出错重要；他有自我选择的勇气，比选择正确重要。</p>--}}
                                {{--<p>「天生万物人为贵」</p>--}}
                            </div>
                        </div>
                        <a href="{!! $articles[$articleID]['href'] !!}"
                           {{--<a href="/human/road/great-zouzhe-China"--}}
                           class="pure-kaiti quote-src btn btn-warning btn-primary-outline btn-sm">
                            {!! $articles[$articleID]['title'] !!}
                            {{--童年需要“试误”和“不听话”--}}
                            {{--中囶历史上的伟大奏折--}}
                        </a>

                    </div>
                    <div id="first-page-space">
                    </div>
                    <div id="first-page-map">
                        <div class="map"></div>
                        <span id="LMap-addr"></span>
                    </div>

                </div>

            </div>
        </div>
    </div>


    @include('partials.columns._home-body-'.$LOCALE)

    <div class="container columns text-center heiti" id="zc-map">
        <h2 class="h2title">真城地图
        </h2>

        <div class="row">
            @include('partials.columns._map-'.$LOCALE)
        </div>
    </div>

@stop

@section('bottom')
    <script>
        /**
         * -  _bigHref
         * -  ZCMap
         * -  firstQuoteShow
         * -  showPlotsForLi
         */


        /**
         * this var is also used by $('#header-nav li').mouseenter,
         * so that mouseover around #header-nav only for #header-nav, not for firstQuoteShow
         *
         * @type {null|int}
         */
        var firstQuoteTimer = null;
        function dependent_func() {
            zc.content._bigHref();

            var firstQuoteEle = $('#first-page-quote');
            var defaultArticleID ={!! $articleID !!};
            var currentArticleId ={!! $articleID !!};


            function firstQuoteShow(bShow) {
                if (firstQuoteTimer) {
                    clearTimeout(firstQuoteTimer)
                }
                firstQuoteTimer = setTimeout(function () {
                    if (!bShow) {
                        firstQuoteEle.hide();
                        return;
                    }

                    firstQuoteEle.show();

                    zcmap.resetDataAndShow({
                        plotsIDs: [currentArticleId],
                        plots: [articlesPlots[currentArticleId]],
                    });

                }, 80)
            }

            $('#header-row')
                .mouseenter(function () {
                    firstQuoteShow(1);
                })
                .mouseover(function () {
                    firstQuoteShow(1);
                })
                .click(function () {
                    firstQuoteShow(1);
                });
            $('#first-page-space').click(function () {
                firstQuoteShow(1);
            });

            var IDs = {!! $IDs !!};
            var plots = {!! $plots !!};
            var articlesPlots =
                    {!! json_encode($articles) !!}

            var lastPlotsGroup = '';

            var zcmap = new ZCMap(
                {
                    ele: $("#first-page-map"),
                    plotsIDs: [currentArticleId],
                    plots: [articlesPlots[currentArticleId]],
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

                firstQuoteShow(0);

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
                if (firstQuoteTimer) {
                    clearTimeout(firstQuoteTimer)
                }
                showPlotsForLi(this, false);
                return false;
            });

            // for cell phone
            if ('ontouchstart' in document) {

                $('#header-nav a').on('touchstart click', function (e) {

                    showPlotsForLi(this.parentElement, true);
                    return false;
                });

                $('#first-page-space').on('touchstart', function () {
                    firstQuoteShow(1);
                });

            }


            $.ajax({
                url: "https://cdn.bootcss.com/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js",
                dataType: "script",
                cache: true,
                success:
                    function (data, textStatus, jqxhr) {

                        // 宽屏上3个以上的子栏目是隐藏的 鼠标滚动显示 一个大栏目最多支持6个子栏目

                        var ele = $('.row-more-cols');

                        if (!ele.mousewheel) return;

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


                    }

            });

        };



        //# sourceURL=zc_home
    </script>
@stop
