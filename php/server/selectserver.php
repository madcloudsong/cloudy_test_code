<?php

/**
 * Simple Description file selectserver
 * 
 * Complete Description of  selectserver
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
socket_set_nonblock($sock) or die("socket_set_block() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");
socket_setopt($sock, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($sock, $host, $port) or die("socket_bind() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");

$result = socket_listen($sock, 4) or die("socket_listen() fail:" . socket_strerror(socket_last_error()) . "/n");
echo "OK\nBinding the socket on $host:$port ... ";
echo "OK\nNow ready to accept connections.\nListening on the socket ... \n";

$main_socket = $sock;
$clients = array();
$max_active = 0;
$max_accept = 0;

while (true) {
    //add main listen socket
    $read = array($main_socket);
    //add client sockets
    foreach ($clients as $i => $fd) {
        if (!empty($fd)) {
            $read[] = $fd;
        }
    }
    echo count($clients) . " clients now \n";
    $ready = socket_select($read, $write = null, $except = null, NULL);
    //select failed
    if ($ready === false) {
        echo "socket_select error\n";
        socket_close($main_socket);
        foreach ($clients as $i => $fd) {
            if (!empty($fd)) {
                socket_close($fd);
            }
        }
        exit;
    }

    echo "ready socket: " . $ready . "\n";

    if ($ready > $max_active) {
        $max_active = $ready;
    }
    echo "max ready socket: " . $max_active . "\n";
    foreach ($read as $fd) {
        if ($fd == $main_socket) {
            $i = 0;
            do {
                //它接收连接请求并调用一个子连接Socket来处理客户端和服务器间的信息    
                $msgsock = socket_accept($main_socket);
                if ($msgsock === false) {
                    break;
                }

                $clients[] = $msgsock;
                $i++;
            } while (true);
            echo $i . " new client arrives\n";
            if ($i > $max) {
                $max = $i;
            }
            echo $max . " max new client arrives\n";
        } else {
            //读取客户端数据    
            echo "Read client data \n";
            //socket_read函数会一直读取客户端数据,直到遇见\n,\t或者\0字符.PHP脚本把这写字符看做是输入的结束符.    
            $buf = socket_read($fd, 8192, PHP_BINARY_READ);
            echo "socket_last_error: " . socket_last_error($sock) . "\n";
            //$buf can be 0, false and '' in different system 
            if ($buf == NULL ) {
                echo "close by peer " . $fd . "\n";
                socket_close($fd);
                $key = array_search($fd, $clients);
                echo "close $key\n";
                unset($clients[$key]);
                continue;
            }
            
            echo "Received msg:  " . var_export($buf, true) . "\n";

            //数据传送 向客户端写入返回结果    
            $msg = "welcome \n";
            socket_write($fd, $msg, strlen($msg));

            if (trim($buf) == "bye") {
                //接收到结束消息，关闭连接，等待下一个连接  
                socket_close($fd);
                $key = array_search($fd, $clients);
                echo "close $key";
                unset($clients[$key]);
            }
        }
    }
};
socket_close($sock);
