<?php

use Wrench\Application\Application;
use Wrench\Application\NamedApplication;

/**
 * Example application for Wrench: echo server
 */
class ChatApplication extends Application {

    protected $clients = array();
    protected $lastTimestamp = null;

    protected function broadcast($msg) {
        $data = array(
            'cmd' => 2,
            'msg' => $msg,
        );
        foreach ($this->clients as $key => $client) {
            $client['c']->send(json_encode($data));
        }
    }

    protected function setName($client, $name) {
        $this->clients[$client->getId()]['name'] = $name;
        $data = array(
            'cmd' => 1,
            'name' => $name,
        );
        $this->clients[$client->getId()]['c']->send(json_encode($data));
    }

    /**
     * @see Wrench\Application.Application::onConnect()
     */
    public function onConnect($client) {
        var_dump($client->getId());
        $this->clients[$client->getId()] = array(
            'c' => $client,
            'name' => 'annony',
        );
        echo "new client connect\n";
    }

    /**
     * Optional: handle a disconnection
     *
     * @param
     */
    public function onDisconnect($client) {
        $name = $this->clients[$client->getId()]['name'];
        unset($this->clients[$client->getId()]);
        $this->broadcast("tototo, {$name} has gone...");
        echo "disconnect\n";
    }

    /**
     * @see Wrench\Application.Application::onUpdate()
     */
    public function onUpdate() {
        // limit updates to once per second
        if (time() > $this->lastTimestamp + 60) {
            $this->lastTimestamp = time();
            $this->broadcast("Current time is " . date('d-m-Y H:i:s'));
        }
    }

    /**
     * @see Wrench\Application.Application::onData()
     */
    public function onData($data, $client) {
        $params = json_decode($data, true);
        switch ($params['cmd']) {
            case 1:
                $this->setName($client, $params['name']);
                $this->broadcast("tototo, {$params['name']} is coming...");
                break;
            case 2:
                $this->broadcast("{$this->clients[$client->getId()]['name']} : {$params['msg']}");
                break;
            default:;
        }
    }

}
