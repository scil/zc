<?php

// composer require apache/thrift

include '../../vendor/autoload.php';

$GEN_DIR = __DIR__.'/../gen-php';
$PORT=7911;

include $GEN_DIR.'/MarkdownService.php';
include $GEN_DIR.'/Types.php';

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TSocket;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Thrift\Exception\TException;

try {

  $socket = new TSocket('localhost', $PORT);

  $transport = new TBufferedTransport($socket, 1024, 1024);
  $protocol = new TBinaryProtocol($transport);
  $client = new MarkdownServiceClient($protocol);

  $transport->open();

 $code = "**abc** ";
  $sum = $client->encode($code);
  print "$code: $sum\n";

  $transport->close();

} catch (TException $tx) {
  print 'TException: '.$tx->getMessage()."\n";
}

?>