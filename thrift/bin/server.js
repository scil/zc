var thrift = require('thrift');

var MarkdownService = require('./../gen-nodejs/MarkdownService.js'),
    ttypes = require('./../gen-nodejs/zc_types');	
    
const md = require('./../../resources/js/markdownit.js')();
const minify = require('html-minifier').minify;

const port = 7911;

var server = thrift.createServer(MarkdownService, {
   encode: function(code, result) {
   	const html = minify(md.render(code));
   	result(null, html );
  }
});

server.listen(port);

console.log('server start');

server.on("error",function(e){
    console.log(e);
});