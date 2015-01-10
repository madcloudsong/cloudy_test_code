<?php

/**
 * Simple Description file Player
 * 
 * Complete Description of  Player
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-1-11
 */
class Player {
    public function getName() {
        return 'cloud';
    }

    public function add($a, $b) {
        return $a + $b;
    }

    public function isGood() {
        return false;
    }
}
