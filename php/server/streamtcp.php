<?php

/**
 * Simple Description file streamtcp
 * 
 * Complete Description of  streamtcp
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-11-5
 */
//服务器信息  
$server = 'tcp://127.0.0.1:9998';
//消息结束符号  
$msg_eof = "\n";
$socket = stream_socket_server($server, $errno, $errstr, STREAM_SERVER_BIND | STREAM_SERVER_LISTEN);
if (!$socket) {
    die("$errstr ($errno)");
}

while ($conn = stream_socket_accept($socket)) {
    fwrite($conn, 'The local time is ' . date('n/j/Y g:i a') . "\n");
    $out = fread($conn, 65535);
    fwrite($conn, 'welcome');
    var_dump($out);
    fclose($conn);
}
fclose($socket);
