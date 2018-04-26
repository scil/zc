#!/usr/bin/env node

const fs = require('fs');
const process = require('process');
const minify = require('html-minifier').minify;
const program = require('commander');

// const md = require('./resources/js/markdownit.js')();
const md = require('./../js/markdownit.js')();

program
    .version('0.0.1')
    .usage('parse markdown file on server ')
    .option('-i, --input_file <value>', 'source file containg markdown')
    .option('-h, --html_file [value]', 'output html file, not needed for -I')
    .parse(process.argv);


// file is included here:
// In Node.js, how do I “include” functions from my other files?
//http://stackoverflow.com/questions/5797852/in-node-js-how-do-i-include-functions-from-my-other-files
// eval(fs.readFileSync('./resources/js/_markdownit.js') + '');
// eval(fs.readFileSync('./resources/js/zc.js') + '');


var sourceFile = program.input_file,
    htmlFile = program.html_file;

var sourceText = fs.readFileSync(sourceFile, "utf8");

if (htmlFile) {
    fs.writeFileSync(htmlFile, minify(md.render(sourceText)), 'utf8');
}


