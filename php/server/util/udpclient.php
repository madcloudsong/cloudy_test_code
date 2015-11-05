<?php

/**
 * Simple Description file udpclient
 * 
 * Complete Description of  udpclient
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-11-5
 */
$host = '127.0.0.1';
$port = 9999;
$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
//socket_set_nonblock($sock);
$in = 'testdata';
$len = strlen($in);
if (socket_sendto($sock, $in, $len, 0, $host, $port) != $len) {
    var_dump(false);
}

$out = '';
$ip = '';
$p = 0;
socket_recvfrom($sock, $out, 65535, 0, $ip, $p) or die("socket_recvfrom() failed: reason: " . socket_strerror(socket_last_error()) ."/n");
var_dump($out, $ip, $p);