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
event_set($listenEvent, $socket, EV_READ | EV_PERSIST, 'onAccept', compact("baseEvent"));
event_base_set($listenEvent, $baseEvent);
event_add($listenEvent);
echo "server start \n";
event_base_loop($baseEvent);
$clients = array();

function onAccept($socket, $flag, $arg)  {
    $base = $arg['baseEvent'];
    echo "new client arrives $socket\n";
    $conn = stream_socket_accept($socket);
    stream_set_blocking($conn, 0);
    $buffer = event_buffer_new($conn, 'onRead', 'onWrite', 'onError', $conn);
    global $clients;
    $clients[] = $conn;
    $clients[] = $buffer;
    event_buffer_base_set($buffer, $base) or die('event_buffer_base_set');
    event_buffer_timeout_set($buffer, 30, 30); 
    event_buffer_watermark_set($buffer, EV_READ, 0, 0xffffff);
    event_buffer_priority_set($buffer, 10); 
    event_buffer_enable($buffer, EV_READ | EV_PERSIST); 
    echo "end on Accept\n";
}

function onRead($buffer, $connection) {
    echo "onread $connection\n";
    $read = event_buffer_read($buffer, 256);
    var_dump($read);
    event_buffer_write($buffer, 'testdata');
    echo "onread end;\n";
    sleep(2);
    echo "after sleep\n";
}

function onWrite($buffer, $arg){
    echo "onwrite $arg\n";
}

function onError($buffer, $error, $connection) {
    // If this was a read timeout
//    if ($error == (EVBUFFER_READ | EVBUFFER_TIMEOUT)) {
//        echo '5 seconds of inactivity'."\n";
//
//        // Control timeout features
//        //    Could ping the client, or even disconnect the client if you really wanted to.
//        //    --- ETC
//
//        // Restart our event loop on this buffer
//        event_buffer_enable($buffer, EV_READ);
//    }
    echo "onerro $error ||| $connection\n";
    event_buffer_disable($buffer, EV_READ | EV_WRITE);                 
 
    event_buffer_free($buffer);                 
 
    fclose($connection);  
}

