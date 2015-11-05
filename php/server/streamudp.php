<?php

/**
 * Simple Description file streamudp
 * 
 * Complete Description of  streamudp
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-11-5
 */
//服务器信息  
$server = 'udp://127.0.0.1:9999';  
//消息结束符号  
$msg_eof = "\n";  
$socket = stream_socket_server($server, $errno, $errstr, STREAM_SERVER_BIND);  
if (!$socket) {  
    die("$errstr ($errno)");  
}  
  
do {  
    //接收客户端发来的信息  
    $inMsg = stream_socket_recvfrom($socket, 1024, 0, $peer);  
    //服务端打印出相关信息  
    echo "\nClient : $peer\n";  
    echo "Receive : {$inMsg}";  
    //给客户端发送信息  
    $outMsg = substr($inMsg, 0, (strrpos($inMsg, $msg_eof))).' -- '.date("D M j H:i:s Y\r\n");  
    stream_socket_sendto($socket, $outMsg, 0, $peer);  
} while ($inMsg !== false);  
