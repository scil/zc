var thrift = require('thrift');
var MarkdownService = require('./../gen-nodejs/MarkdownService.js'),
    ttypes = require('./../gen-nodejs/zc_types');	
const assert = require('assert');

var transport = thrift.TBufferedTransport;
var protocol = thrift.TBinaryProtocol;

var connection = thrift.createConnection("localhost", 7911, {
  transport : transport,
  protocol : protocol
});

connection.on('error', function(err) {
  assert(false, err);
});

// Create a  client with the connection
var client = thrift.createClient(MarkdownService, connection);


const code = "**abc** ";

client.encode(code, function(err, response) {
	if (err) {
            console.error(err);
        } else{
		  console.log(code + ' : ' + response);
	}

    //close the connection once we're done
    connection.end();
});


