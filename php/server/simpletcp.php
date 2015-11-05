<?php

/**
 * Simple Description file simpletcp
 * 
 * Complete Description of  simpletcp
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-11-5
 */
$host = '127.0.0.1';
$port = 9998;
$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("socket_create() 失败的原因是:" . socket_strerror(socket_last_error()) . "\n");
socket_set_block($sock) or die("socket_set_block() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");

socket_bind($sock, $host, $port)  or die("socket_bind() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");

$result = socket_listen($sock, 4) or die("socket_listen() fail:" . socket_strerror(socket_last_error()) . "/n");    
echo "OK\nBinding the socket on $host:$port ... ";    
echo "OK\nNow ready to accept connections.\nListening on the socket ... \n";    
do { // never stop the daemon    
    //它接收连接请求并调用一个子连接Socket来处理客户端和服务器间的信息    
    $msgsock = socket_accept($sock) or  die("socket_accept() failed: reason: " . socket_strerror(socket_last_error()) . "\n");    
    while(1){  
        //读取客户端数据    
        echo "Read client data \n";    
        //socket_read函数会一直读取客户端数据,直到遇见\n,\t或者\0字符.PHP脚本把这写字符看做是输入的结束符.    
        $buf = socket_read($msgsock, 8192);    
        echo "Received msg: $buf   \n";  
  
        //数据传送 向客户端写入返回结果    
        $msg = "welcome \n";    
        socket_write($msgsock, $msg, strlen($msg)) or die("socket_write() failed: reason: " . socket_strerror(socket_last_error()) ."/n");  
        
        if(trim($buf) == "bye"){  
            //接收到结束消息，关闭连接，等待下一个连接  
            socket_close($msgsock);  
            break;  
        }  
    }    
        
} while (true);    
socket_close($sock);