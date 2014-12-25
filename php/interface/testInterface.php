<?php

/**
 * Simple Description file testInterface
 * 
 * Complete Description of  testInterface
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-25
 */
require 'Bird.php';

function run(IFlyable $it) {
    $it->fly();
}

$bird = new Bird();
$bird->fly();

run($bird);
