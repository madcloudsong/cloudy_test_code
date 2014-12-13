<?php

/**
 * Simple Description file ZooHelper.php
 * 
 * Complete Description of  ZooHelper.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-3 15:40:08
 */
class ZooHelper {

    const PERSISTENT = 0;
    const EPHEMERAL = Zookeeper::EPHEMERAL;
    const SEQUENCE = Zookeeper::SEQUENCE;
    const PERM_READ = Zookeeper::PERM_READ;
    const PERM_WRITE = Zookeeper::PERM_WRITE;
    const PERM_CREATE = Zookeeper::PERM_CREATE;
    const PERM_DELETE = Zookeeper::PERM_DELETE;
    const PERM_ADMIN = Zookeeper::PERM_ADMIN;
    const PERM_ALL = Zookeeper::PERM_ALL;

    /**
     *
     * @var Zookeeper 
     */
    public $zok;
    public $callback = array();
    public $auth = array();
    public $servers;

    /**
     * array或者直接字符串，形如1.1.1.1:3181
     * @param mixed $servers
     */
    public function __construct($servers) {
        $this->servers = $servers;
        $this->zok = new Zookeeper($this->_getServers());
    }

    private function _getServers() {
        if (!is_array($this->servers)) {
            return $this->servers;
        }
        return implode(',', $this->servers);
    }

    /**
     * 创建path
     * @param string $path
     * @param string $value
     */
    public function makePath($path, $value = '') {
        $parts = explode('/', $path);
        $parts = array_filter($parts);
        $subpath = '';
        while (count($parts) > 1) {
            $subpath .= '/' . array_shift($parts);
            if (!$this->zok->exists($subpath)) {
                $this->makeNode($subpath, $value);
            }
        }
    }

    /**
     * 创建节点
     * @param string $path
     * @param string $value
     * @param array $params
     * @param int $flags
     * @return type
     */
    public function makeNode($path, $value, array $params = array(), $flags = self::PERSISTENT) {
        if (empty($params)) {
            $params = array(
                array(
                    'perms' => Zookeeper::PERM_ALL,
                    'scheme' => 'world',
                    'id' => 'anyone',
                )
            );
        }
        return $this->zok->create($path, $value, $params, $flags);
    }

    public function set($path, $value) {
        if (!$this->zok->exists($path)) {
            $this->makePath($path);
            $this->makeNode($path, $value);
        } else {
            $this->zok->set($path, $value);
        }
    }

    public function exists($path) {
        return $this->zok->exists($path);
    }

    public function get($path) {
        return $this->zok->get($path);
    }

    /**
     * 
     * @param string $path
     * @param callback $callback
     * @param string $auth
     * @return mixed
     */
    public function watch($path, $callback, $auth = null) {
        if ($this->zok->exists($path)) {
            if (!isset($this->callback[$path])) {
                $this->callback[$path] = $callback;
                if ($auth !== null) {
                    $this->auth[$path] = $auth;
                    $this->addAuth($this->auth[$path]);
                }
                $ret = $this->zok->get($path, array($this, 'watchCallback'));
                $this->log("set watch");
            }
        }
        return $ret;
    }

    /**
     * watch callback
     * @param int $event_type
     * @param int $stat
     * @param string $path
     */
    public function watchCallback($event_type, $stat, $path) {
        if (empty($path)) {
            if ($event_type == Zookeeper::SESSION_EVENT) {
                if ($stat == Zookeeper::EXPIRED_SESSION_STATE) {
                    $this->zok->connect($this->_getServers()); //,  array($this, 'watchCallback'));
                    foreach ($this->callback as $path => $callback) {
                        if (isset($this->auth[$path])) {
                            $this->addAuth($this->auth[$path]);
                        }
                        $data = $this->zok->get($path, array($this, 'watchCallback'));
                        call_user_func($callback, $event_type, $stat, $path, $data, $this);
                    }
                    $this->log(__LINE__ . "ready to connect");
                    return null;
                } else if ($stat == Zookeeper::CONNECTED_STATE) {
                    $this->log(__LINE__ . "connected");
                } else if ($stat == Zookeeper::CONNECTING_STATE) {
                    $this->log(__LINE__ . "lost connection");
                }
                return null;
            }
        } else {
            $callback = $this->callback[$path];
            if (isset($this->auth[$path])) {
                $this->addAuth($this->auth[$path]);
            }
            $data = $this->zok->get($path, array($this, 'watchCallback'));
            return call_user_func($callback, $event_type, $stat, $path, $data, $this);
        }
    }

    /**
     * 生成节点的权限配置数组
     * @param string $user
     * @param string $password
     * @param int $perms
     * @return array
     */
    public function genAuthArray($user, $password, $perms = self::PERM_ALL) {
        $id = $user . ':' . base64_encode(pack('H*', sha1("$user:$password")));
        return array(
            'perms' => $perms,
            'scheme' => 'digest',
            'id' => $id,
        );
    }

    /**
     * 传入鉴权用户名密码,形如admin:admin
     * @param string $auth
     * @return bool
     */
    public function addAuth($auth) {
        $ret = $this->zok->addAuth('digest', $auth);
        return $ret;
    }

    public function unwatch($path = self::CONFIG_PATH) {
        unset($this->callback[$path]);
    }

    protected function log($string) {
        echo $string . "\n";
    }

}
