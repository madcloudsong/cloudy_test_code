<?php

/**
 * Simple Description file microtime.php
 * 
 * Complete Description of  microtime.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-30 10:08:32
 */
var_dump(microtime());//string(21) "0.73353200 1419905409"
var_dump(microtime(true));//float(1419905409.7335)
var_dump(microtime() + 1);//float(1.733545) 
var_dump(time());