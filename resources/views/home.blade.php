@extends('layouts.base',['title'=>'真城','desc'=>'真之城，致敬真，致敬理想主义！'])


@section('header')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="quote-body first-page" id="home-first-page">
                    <style>
                        #home-first-page {
                            padding: 50px 35px;
                        }
                        .map{
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
                    <div class="map"></div>

                    <script>
                        IDs = {!! json_encode($IDs) !!};
                        plots = {!! json_encode($plots) !!};

                        lastPlotsGroup = '/green';

                        zcmap = new ZCMap(
                            {
                                ele: $("#home-first-page"),
                                plotsIDs: IDs[lastPlotsGroup],
                                plots: plots[lastPlotsGroup],
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
                        $('#header-nav a').mouseenter(function () {
                            var url = this.getAttribute('href');
                            if (url == lastPlotsGroup) return;
                            lastPlotsGroup = url;
                            $(this).parent().addClass('active').siblings().removeClass('active');
                            zcmap.resetDataAndShow({
                                plotsIDs: IDs[lastPlotsGroup],
                                plots: plots[lastPlotsGroup],

                            });
                        });
                        //# sourceURL=zc_home_map
                    </script>
                </div>
            </div>
        </div>
    </div>


    @include('partials.columns._home-body')

    <script>

        zc.content._bigHref();

        // 宽屏上3个以上的子栏目是隐藏的 鼠标滚动显示 一个大栏目最多支持6个子栏目
        !function () {
            var ele = $('.row-more-cols');

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

            ele.on('mousewheel', function (e) {
                e.stopPropagation();
                e.preventDefault();
                scrollColumns($(this));
            });

        }();

        //# sourceURL=zc_home
    </script>

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
    </script>
@stop
