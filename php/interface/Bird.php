<?php

/**
 * Simple Description file Bird
 * 
 * Complete Description of  Bird
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-25
 */
require 'IFlyable.php';

class Bird implements IFlyable{
    public function fly() {
        var_dump('bird fly');
    }
}
