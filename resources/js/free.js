// @flow


/*
 *
 * free.decodeTagedHtmlStringByDom( free.encodeTagedHtmlStringByDom( md.render(editor.value() ) )  )
 *
 * 每个z-free独立保存自己的code：
 * free.decodeTagedHtmlStringByDom( free.encodeTagedHtmlStringByDom( md.render(editor.value()), true ), true  )
 * */

var free = {
    e: '\u771f'.charCodeAt(0), // 30495
    _encodeCharCode: function (code: number): string {
        var n = code - free.e;

        if (n % 2 == 0) {
            n = n * 2;
        } else {
            n = n * 3;
        }

        n = n.toString();

        if (n.length > 6)
            console.error('free._encodeCharCode for : ' + n);

        // 左填充0 以补足6位
        n = ['', '0', '00', '000', '0000', '00000'][6 - n.length] + n;

        return n;

    },
    _decodeCharCode: function (charCode: string): string {
        // 先去掉前面的0 再parseInt 否则 parseInt('00-231') 得到 0
        var code = parseInt(charCode.substr(charCode.lastIndexOf('0-') + 1), 10);

        if (code % 2 == 0) {
            code = code / 2;
        } else {
            code = code / 3;
        }
        return String.fromCharCode(code + free.e);

    },
    encodeText: function (text: string): string {
        var c = [];
        for (var i = 0; i < text.length; i++) {
            c.push(free._encodeCharCode(text.charCodeAt(i)));
        }
        var code = c.join('')
        if (text == free.decodeTextCode(code)) {
            return code;
        } else {
            alert('wrong free.encodeText for ' + text);
        }

    },
    decodeTextCode: function (code: string): string {
        var text = [], lastCharIndex = code.length - 6;
        for (var i = 0; i <= lastCharIndex; i = i + 6) {
            text.push(free._decodeCharCode(code.substr(i, 6)))
        }
        return text.join('');
    },
    _placeHolder: function (text: string): string {
        var placeholder = '', i = text.length;
        while (i--) {
            placeholder += text.charCodeAt(i) > 255 ? '__' : '_';
        }
        return placeholder;

    },
    /**
     *
     * @param ele
     * @param codes optional,编码可在每个元素上(independent)，也可在codes里面
     * @private
     */
    _decodeDomTree: function (ele, codes?: string | Array) {
        var freeTags = ele.getElementsByTagName(free.tag);
        if (!freeTags) {
            return;
        }
        if (typeof(codes) == 'string')
            codes = codes.split('+');

        var freeEle, indexNotDependent = -1, code;
        for (var i = 0, len = freeTags.length; i < len; i++) {
            freeEle = freeTags[i];
            // 如果有 data-c，就是独立编码，不需要从 codes中寻找
            if (freeEle.hasAttribute('data-c')) {
                freeEle.textContent = free.decodeTextCode(ele.getAttribute('data-c'));
                freeEle.removeAttribute('data-c');
            } else {
                indexNotDependent++;
                if (freeEle.hasAttribute('data-i')) {
                    code = codes[parseInt(freeEle.getAttribute('data-i'))];
                    freeEle.removeAttribute('data-i');
                } else {
                    code = codes[indexNotDependent];
                }
            }
            freeEle.textContent = free.decodeTextCode(code)
        }


    },
    // 公共编码存在每个tree的最后一个子元素上
    decodeDomTrees: function ($eles) {
        $eles.each(function () {
            var codes = null;
            if (this.lastElementChild.hasAttribute('data-c'))
                codes = this.lastElementChild.getAttribute('data-c')
            free._decodeDomTree(this, codes);
        })
    }
    ,

    /**
     * 每个tag的code存到自己身上
     *
     * test:
     * free.encodeTagedStringIndependently('<z-free>6</z-free><z-free >87</z-free><z-free ok="3" >6</z-free>')
     */
    encodeTagedStringIndependently: function (rawStr) {
        var encoded = rawStr.replace(/<z-free(.*?)>(.+?)<\/z-free>/g, function (match, attris, text) {
            return '<z-free data-c="' + free.encodeText(text) + '"' + attris + '>' + free._placeHolder(text) + '</z-free>';
        });
        var restored = free.decodeTagedStringIndependently(encoded);
        if (restored == rawStr) {
            return encoded;
        } else {
            console.error('free.encodeTagedStringIndependently ');
            console.log('origin: ', rawStr);
            console.log('restored: ', restored);
            console.log('recoded : ', encoded);
        }

    }
    ,
    decodeTagedStringIndependently: function (codedStr) {
        return codedStr.replace(/<z-free data-c="(\S+)"(.*?)>.+?<\/z-free>/g, function (match, code, attris) {
            return '<z-free' + attris + '>' + free.decodeTextCode(code) + '</z-free>';
        });

    }
    ,
    /**
     *
     * 所有tag的code都放到一个字符串里面
     *
     * test:
     * free.encodeTagedString('<z-free en="oky ">6</z-free>')
     * free.encodeTagedString('等到<z-free en=" gunshot rang out">枪响</z-free>。黄渝拿「<z-free en=" June_F Green Card">绿卡</z-free>」我')
     * free.encodeTagedString('<z-free es="oky ">6</z-free>a<z-free>8</z-free>aaaa<z-free>6</z-free>')
     */
    encodeTagedString: function (rawStr) {

        var all_codes = [], currentCode, currentCodeIndex = 0, tagIndex = -1;
        var encoded = rawStr.replace(/<z-free(?: (en|es|ru)="([^"]+?)")?(.*?)>(.+?)<\/z-free>/g, function (match, lang, alt, attris, text) {
            tagIndex++;


            currentCode = free.encodeText(text);
            currentCodeIndex = all_codes.indexOf(currentCode);

            if (currentCodeIndex == -1) {
                all_codes.push(currentCode);
                currentCodeIndex = all_codes.length - 1;
            }

            var placeHolderText = alt || free._placeHolder(text);

            var langAttri = '';
            if (alt && lang) {
                langAttri = ' lang="' + lang + '"'
            }

            if (currentCodeIndex != tagIndex) {
                return '<z-free' + langAttri + ' data-i="' + currentCodeIndex + '"' + attris + '>' + placeHolderText + '</z-free>';
            }
            return '<z-free' + langAttri + attris + '>' + placeHolderText + '</z-free>';
        });


        var codes = all_codes.join('+');
        var restored = this.decodeTagedString(encoded, codes);
        if (restored == rawStr) {
            return {
                s: encoded,
                codes: codes
            }
        } else {
            console.error('free.encodeTagedString');
            console.log('origin: ', rawStr);
            console.log('restored: ', restored);
            console.log('recoded : ', encoded);
        }

    }
    ,
    decodeTagedString: function (codedStr, codes) {

        codes = codes.split('+');
        var tagIndex = -1;
        return codedStr.replace(/<z-free(?: lang="(en|es)")?(?: data-i="(\w+?)")?(.*?)>(.+?)<\/z-free>/g, function (match, lang, codeIndex, attris, alt) {
            codeIndex = codeIndex || ++tagIndex;
            if (lang) {
                return '<z-free ' + lang + '="' + alt + '"' + attris + '>' + free.decodeTextCode(codes[codeIndex]) + '</z-free>';
            } else {
                return '<z-free' + attris + '>' + free.decodeTextCode(codes[codeIndex]) + '</z-free>';
            }
        })
    },
    hasZcCode: function (s) {
        return s && s.indexOf('<' + free.tag) > -1;
    }
}


free.tag = free.decodeTextCode("-91119-60900-91179-91143-60788-60788"); //  'z-free'

module.exports = free;
