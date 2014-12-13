<?php

/**
 * Simple Description file ShmHelper.php
 * 
 * Complete Description of  ShmHelper.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-3 15:42:33
 */
class ShmHelper {

    public static $key = 123456;
    public static $size = 20241024;
    public static $perm = 0666;
    public $shmid = null;

    public function __construct() {
        $this->shmid = shmop_open(self::$key, 'c', self::$perm, self::$size);
        var_dump('shmid : ' . $this->shmid);
    }

    public function set($content) {
        $string = json_encode($content);
        $len = strlen($string);
        $p = pack("I*", $len);
        var_dump('shmset : ' . strlen($p));
        shmop_write($this->shmid, $p, 0);
        return shmop_write($this->shmid, $string, 4);
    }

    public function get() {
        $len = shmop_read($this->shmid, 0, 4);
        $len = unpack("I*", $len);
        var_dump('len : ' . var_export($len, true));
        $content = json_decode(shmop_read($this->shmid, 4, $len[1]), true);
        var_dump('shmget : ' . $content);
        return $content;
    }

}
