
# url


## support for urls like '/zh', '/zh/being'
`
SUPPORT_URL_WITH_DEFAULT_LOCALE = true,
`
# front end

切换语言必须刷新全页面 而不可借助于pjax 以更新layout和js变量

data-locale 里面必须使用url所用的locale名称，即 zh, en。日后如果增加新locale，也要如此。
```html
    <li><a id="select-lang" data-locale="/{!! $LOCALE==='zh'?'en':'zh' !!}">{!! $LOCALE==='zh'?'EN':'ZH' !!}</a></li>
```

# menu items and local

two constantcs ZC_HEADERS and MENU_ITEMS in two files produced by Staticizer.php:  
- D:\vagrant\www\zc\bootstrap\cache2\headers.php
- D:\vagrant\www\zc\bootstrap\cache2\menu_items.php

for dif locals, multiple versions of resources/views/_s/partials/columns/*.blade.php produced by Staticizer.php

# view share var

**$LOCALE** is defined in a middleware, and used in view files.