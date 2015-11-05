<?php

/**
 * Simple Description file simpleudp
 * 
 * Complete Description of  simpleudp
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-11-5
 */
$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP) or die("socket_create() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");
socket_set_nonblock($sock) or die("socket_set_block() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");
socket_bind($sock, '127.0.0.1', 9999)  or die("socket_bind() 失败的原因是:" . socket_strerror(socket_last_error()) . "/n");
while (true) {
    $out = '';
    socket_recvfrom($sock, $out, 65535, MSG_DONTWAIT, $ip, $port);
    var_dump($out, $ip, $port);
    var_dump($out);
    if(strlen($out) > 0) {
        socket_sendto($sock, $out, strlen($out), MSG_DONTWAIT, $ip, $port);
    }
}
