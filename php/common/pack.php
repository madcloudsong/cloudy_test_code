<?php

/**
 * Simple Description file pack.php
 * 
 * Complete Description of  pack.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-1 14:42:04
 */
$buffer = pack("I", 50);
var_dump($buffer);
$buffer .= pack("I", 60);
var_dump($buffer);
$data = unpack("I*", $buffer);
var_dump($data);
$data1 = unpack("I", $buffer);
var_dump($data1);
$data2 = unpack("Ione", $buffer);
var_dump($data2);
//string(4) "2" string(8) "2<" array(2) { [1]=> int(50) [2]=> int(60) } array(1) { [1]=> int(50) } array(1) { ["one"]=> int(50) } 
