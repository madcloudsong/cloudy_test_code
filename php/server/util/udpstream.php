<?php

/**
 * Simple Description file udpstream
 * 
 * Complete Description of  udpstream
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-11-5
 */
$host = '127.0.0.1';
$port = 9999;
$url = "udp://$host:$port";
$fp = stream_socket_client($url, $errno, $errstr, 1);
if (!$fp) {
    die("ERROR: {$errno} - {$errstr}\n");
}
fwrite($fp, "testdata" );
$result = fread($fp, 1024);
fclose($fp);
var_dump($result);
