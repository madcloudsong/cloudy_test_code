<?php

/**
 * Simple Description file Sword
 * 
 * Complete Description of  Sword
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-22
 */
class Sword extends Weapon{
    public $name = 'sword';
    public function __construct() {
        var_dump('sword is created');
    }
}
