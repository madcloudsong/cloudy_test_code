<?php

/**
 * Simple Description file epollserver
 * 
 * Complete Description of  epollserver
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-11-5
 */
$host = '127.0.0.1';
$port = 9998;
$url = "tcp://$host:$port";
$socket = stream_socket_server($url, $errno, $errstr);
stream_set_blocking($socket, 0);
$baseEvent = event_base_new();
$listenEvent = event_new();
event_set($listenEvent, $socket, EV_READ | EV_PERSIST, 'onAccept', $baseEvent);
event_base_set($listenEvent, $baseEvent);
event_add($listenEvent);
echo "server start \n";
event_base_loop($baseEvent);

$clients = array();

function onAccept($socket, $flag, $base) {
    echo "new client arrives $socket\n";
    $conn = stream_socket_accept($socket);
    stream_set_blocking($conn, 0);
    $clientEvent = event_new();
    event_set($clientEvent, $conn, EV_READ | EV_PERSIST, 'onReceive', compact('clientEvent'));
    event_base_set($clientEvent, $base);
    event_add($clientEvent);
    echo "end on Accept\n";
}

function onReceive($socket, $flag, $args) {
    $data = fread($socket, 8096);
    if ($data == null) {
        echo "client close $socket\n";
        stream_socket_shutdown($socket, 2);
        fclose($socket);
        event_del($args['clientEvent']);
        event_free($args['clientEvent']);
    } else {
        echo "new data arrives $socket\n";
//        for ($i = 0; $i < 10; $i++) {
//            sleep(1);
//            var_dump("sleep " . $socket);
//        }
        var_dump($flag);
        var_dump($data);
        fwrite($socket, "testdata\n");
    }
//    sleep(5);
}
