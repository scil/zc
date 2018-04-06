// ********* WARNING
// run `gulp dist:js` after this file is changed
// *********

var MarkDownIt = require('markdown-it');

var getMDParser = function() {
    var options = {
        html: true,
    }
    var md = new MarkDownIt(options);
    md.use(require('markdown-it-ins'))
        .use(require('markdown-it-sup'))
        .use(require('markdown-it-deflist'))
        .use( require('markdown-it-footnote'))
        .use(require('markdown-it-mark'))
        .use(require('markdown-it-external-links'),{
            externalClassName: "external-link",
            internalClassName: "internal-link",
            // internalDomains: [ "zhenc.org" ] ,
            externalTarget:'_blank',
        })
        // 通过markdown-it-decorate的语法来设置id,class或其它属性 如 #id.class title="mm" 可带部分tag: section.ins
        .use(require('markdown-it-container'), 'decorate' , {
            validate: function(params) {
                return params.trim().match(/^(z-deep|div|section)?(.*)$/);
            },

            render: function (tokens, idx) {
                var m = tokens[idx].info.trim().match(/^(z-deep|div|section)?(.*)$/);
// console.log(m)
//                 console.log(tokens)

                var tag=m[1]||'div', attr=m[2];

                if (tokens[idx].nesting === 1) {
                    // opening tag
                    var fake=md.render('TMP_FOR_CONTAINER<!-- {'+ attr +'} -->')
// console.log('fake:',fake)
                    return '<' + tag  + fake.substring(2,  fake.indexOf('>'))+'>\n';

                } else {
                    // closing tag
                    // console.log('tag ',tag)
                    return '</'+tag+'>\n';
                }
            }
        })
        //.use(require('markdown-it-attrs')) // 功能不如下者强大，譬如把cite属性加到blockquote标签上，而非里面的p标签上
        .use(require('markdown-it-decorate'));
    return md;
}

module.exports=getMDParser;
//
// var g;
// if (typeof window !== "undefined") {
//     g = window
// } else if (typeof global !== "undefined") {
//     g = global
// } else if (typeof self !== "undefined") {
//     g = self
// } else {
//     g = this
// }
//
// g.getMDParser = getMDParser;
//

