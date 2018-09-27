
# cdn callback

对 cdn.bootcss.com 提供callback支持，所以只支持中文版本的网页。(英文网页直接使用 cdn.jsdelivr.net)

## tool

test tool: Resource Override

## 最早方案


```html

    <script>
        if (!window.jQuery) {
            ss = '<script src="//cdn.jsdelivr.net/npm/'; se = '"><\/script>';
            document.write(ss + 'jquery@3.3.1/dist/jquery.min.js' + se + ss + 'bootstrap-sass@3.3.7/assets/javascripts/bootstrap.min.js' + se + ss + 'raphael@2.2.7/raphael.min.js' + se);
        }
    </script>

```

## 方案2： defer

希望 jquery 用 defer，那 callback 就需要改造，也支持defer,而 inline script 不支持，但改写为 base64就可以

### 失败尝试: defer 脚本不能用 document.write 

chrome: Failed to execute 'write' on 'Document': It isn't possible to write into a document from an asynchronously-loaded external script unless it is explicitly opened.


base64 to use defer by http://www.utilities-online.info/base64/#.W6Yk7ykalPY  
https://stackoverflow.com/questions/41394983/how-to-defer-inline-javascript



### 不用 document.write 而用 dom 操作

注意：不再单纯加载callback 而是cdn加载完后 重新运行本站脚本 最后运行 dependent_func；因为发现使用了dom操作后，本站脚本并不等待 callback ，自顾自下载运行，所以就需要重新运行。

```javascript
// https://www.js-beautify.com/
        if (!window.jQuery) {

            var h = document.head,

                f = '//cdn.jsdelivr.net/npm/',
                e = '.min.js',
                j = 'jquery',
                b = 'bootstrap',
                r = 'raphael',

                // 把jquery单独一组 因为总是出现 bootstrap先下载运行 即使加上 s.defer=true也不行
                u = [
                    f + j + '@3.3.1/dist/' + j + e,
                ],
                u2 = [
                    f + b + '-sass@3.3.7/assets/javascripts/' + b + e,
                    f + r + '@2.2.7/' + r + e,
                ],

                // querystring 让本站脚本重新下载运行，否则不运行
                q = '?s=4',
                u3 = [
                    '/js/vendor.js' + q,
                    '/js/app.js' + q,
                ];

            function z(u) {
                for (i in u) {
                    s = document.createElement('script');
                    s.src = u[i];
                    h.insertBefore(s, h.firstChild)
                }
            }

            // 加载第一组 cdn 即 jquery
            z(u);

            // 一个组最后一个脚本(s)加载完成后 等待300ms(等待运行), 运行next
            function t(next) {
                s.onload = function() {
                    setTimeout(next, 300);
                }
            }

            // 一个组最后一个脚本(s)加载完成后 等待300ms(等待运行), 加载下一个组
            t(function() {

                    z(u2);
                    t(function() {
                        z(u3);
                        // 给本站脚本重新下载运行 1s 时间
                        t(function() {
                            window.dependent_func && dependent_func();
                        });
                    });
                })

            }
```


compress by https://jscompress.com/
```javascript
if(!window.jQuery){var h=document.head,f="//cdn.jsdelivr.net/npm/",e=".min.js",j="jquery",b="bootstrap",r="raphael",u=[f+j+"@3.3.1/dist/"+j+e],u2=[f+b+"-sass@3.3.7/assets/javascripts/"+b+e,f+r+"@2.2.7/"+r+e],q="?s=4",u3=["/js/vendor.js"+q,"/js/app.js"+q];function z(n){for(i in n)s=document.createElement("script"),s.src=n[i],h.insertBefore(s,h.firstChild)}function t(n){s.onload=function(){setTimeout(n,300)}}z(u),t(function(){z(u2),t(function(){z(u3),t(function(){window.dependent_func&&dependent_func()})})})}
```


base64 to use defer by http://www.utilities-online.info/base64/#.W6Yk7ykalPY  
https://stackoverflow.com/questions/41394983/how-to-defer-inline-javascript

```html
        <script src="data:text/javascript;base64, aWYoIXdpbmRvdy5qUXVlcnkpe3ZhciBoPWRvY3VtZW50LmhlYWQsZj0iLy9jZG4uanNkZWxpdnIubmV0L25wbS8iLGU9Ii5taW4uanMiLGo9ImpxdWVyeSIsYj0iYm9vdHN0cmFwIixyPSJyYXBoYWVsIix1PVtmK2orIkAzLjMuMS9kaXN0LyIraitlXSx1Mj1bZitiKyItc2Fzc0AzLjMuNy9hc3NldHMvamF2YXNjcmlwdHMvIitiK2UsZityKyJAMi4yLjcvIityK2VdLHE9Ij9zPTQiLHUzPVsiL2pzL3ZlbmRvci5qcyIrcSwiL2pzL2FwcC5qcyIrcV07ZnVuY3Rpb24geihuKXtmb3IoaSBpbiBuKXM9ZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgic2NyaXB0Iikscy5zcmM9bltpXSxoLmluc2VydEJlZm9yZShzLGguZmlyc3RDaGlsZCl9ZnVuY3Rpb24gdChuKXtzLm9ubG9hZD1mdW5jdGlvbigpe3NldFRpbWVvdXQobiwzMDApfX16KHUpLHQoZnVuY3Rpb24oKXt6KHUyKSx0KGZ1bmN0aW9uKCl7eih1MyksdChmdW5jdGlvbigpe3dpbmRvdy5kZXBlbmRlbnRfZnVuYyYmZGVwZW5kZW50X2Z1bmMoKX0pfSl9KX0=
" defer></script>
```
