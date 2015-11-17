<?php

/**
 * Simple Description file echoserver
 * 
 * Complete Description of  echoserver
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-1-3
 */
// Server
class Server {

    private $serv;

    public function __construct() {
        $this->serv = new swoole_server("0.0.0.0", 9501);
        $this->serv->set(array(
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 2,
            'debug_mode' => 1
        ));

        $this->serv->on('Start', array($this, 'onStart'));
        $this->serv->on('Connect', array($this, 'onConnect'));
        $this->serv->on('Receive', array($this, 'onReceive'));
        $this->serv->on('Close', array($this, 'onClose'));

        $this->serv->start();
    }

    public function onStart($serv) {
        echo "Start\n";
    }

    public function onConnect($serv, $fd, $from_id) {
        $serv->send($fd, "Hello {$fd}!\n");
    }

    public function onReceive(swoole_server $serv, $fd, $from_id, $data) {
        echo "Get Message From Client {$fd}:{$data}\n";
        $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
        $client->on("connect", function(swoole_client $cli) use ($data) {
            $cli->send("GET $data\n");
        });
        $client->on("receive", function(swoole_client $cli, $data) use ($fd) {
            echo "Receive: $data";
            //$cli->send(str_repeat('A', 100) . "\n");
            sleep(1);
            $this->serv->send($fd, $data);
            $cli->close();
        });
        $client->on("error", function(swoole_client $cli) {
            echo "error\n";
        });
        $client->on("close", function(swoole_client $cli) {
            echo "Connection close\n";
        });
        $client->connect('127.0.0.1', 9998);
        echo "end on receive\n";
    }

    public function onClose($serv, $fd, $from_id) {
        echo "Client {$fd} close connection\n";
    }

}

// 启动服务器
$server = new Server();

