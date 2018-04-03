#!/usr/bin/env node

const fs = require('fs');
const process = require('process');
const minify = require('html-minifier').minify;
const program = require('commander');

const free = require("./resources/js/free");
const md = require('./resources/js/markdownit.js')();

program
    .version('0.0.1')
    .usage('encode <z-free> file or parse markdown file on server ')
    .option('-i, --input_file <value>', 'source file containg markdown or z-free')
    .option('-o, --output_file <value>', 'output file in which z-free are encoded')
    .option('-c, --output_codes_file [value]', 'output codes file, not needed for -I')
    .option('-h, --html_file [value]', 'output html file, not needed for -I')
    .option('-I, --independent', 'no codes file, and only do not parse markdown')
    .parse(process.argv);


// file is included here:
// In Node.js, how do I “include” functions from my other files?
//http://stackoverflow.com/questions/5797852/in-node-js-how-do-i-include-functions-from-my-other-files
// eval(fs.readFileSync('./resources/js/_markdownit.js') + '');
// eval(fs.readFileSync('./resources/js/zc.js') + '');


var sourceFile = program.input_file,
    outputFile = program.output_file,
    codesFile = program.output_codes_file,
    htmlFile = program.html_file;

var sourceText = fs.readFileSync(sourceFile, "utf8");

if (program.independent) {

    var output = free.encodeTagedStringIndependently(sourceText);

    fs.writeFileSync(outputFile, output, 'utf8');

    return;
}


var outputObj = free.encodeTagedString(sourceText);
var hasZFreeTag = outputObj.codes ? true : false;

if (htmlFile) {
    // html代码也经过了一次加密，为什么不直接渲染加密过的md代码？因为 z-free会被生成 __
    // 而 markdown-it 会把 __ 理解为 <strong>
    var htmlText = minify(md.render(sourceText));

    if (hasZFreeTag) {
        var htmlOutputObj = free.encodeTagedString(htmlText);
        if (outputObj.codes != htmlOutputObj.codes) {
            throw 'wrong codes \n' + 'from md: ' + outputObj.codes + '\nfrom html :' + htmlOutputObj.codes;
        }
    }

    fs.writeFileSync(htmlFile, hasZFreeTag ? htmlOutputObj.s : htmlText, 'utf8');
}


fs.writeFileSync(outputFile, outputObj.s, 'utf8');

// 即使没有z-free 也生成作为一个记号，表示为当前源文件加密过
fs.writeFileSync(codesFile, hasZFreeTag ? outputObj.codes : '', 'utf8');



