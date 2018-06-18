<title>{!! $title !!}</title>

{!! ZC_HEADERS[$columnID] !!}

<div class="container pjax">
    @yield('content_top')
</div>

<div class="pjax">
    @yield('content')
</div>

<div class="pjax">
    @yield('bottom')
</div>
