<?php

/**
 * Simple Description file eval
 * 
 * Complete Description of  eval
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-1-10
 */
$p1 = 5;
$p2 = 6;
$str = 'return $p1*$p2+$p1-$p2';
var_dump(eval($str.';'));

