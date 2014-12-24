<?php

/**
 * Simple Description file Weapon
 * 
 * Complete Description of  Weapon
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-22
 */
class Weapon {
    //put your code here
    public $name = 'weapon';
    public function __construct() {
        var_dump('weapon is created.');
    }

    public function attack() {
        var_dump('attack with '.$this->name);
    }
}
