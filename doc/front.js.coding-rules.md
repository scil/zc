
# two types of scripts in html file

## stand alone

不依赖于 jquery, bootstrap, vendor  等库/文件

- every page, except homepage, can define a function names `standalone_func`. In general , put it in section('bottom')

## dependent func

- every page, except homepage, can define a function names `dependent_func`. In general , put it in section('bottom')

- in page content, you can push a functin into  arrays `G_conten_func_pool` or `G_conten_1_func_pool` ,   
functions in the latter array only run once, and do not run when pjax:success.
