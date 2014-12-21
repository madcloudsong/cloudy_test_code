<?php

/**
 * Simple Description file autoload.php
 * 
 * Complete Description of  autoload.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-10-27 16:46:57
 */
$maxHeap = new SplMaxHeap();
$maxHeap->insert(1);
$maxHeap->insert(8);
$maxHeap->insert(2);
$maxHeap->insert(6);
$maxHeap->insert(3);
$maxHeap->insert(9);
while(!$maxHeap->isEmpty()){
    var_dump('top: ' . $maxHeap->extract());
    var_dump('count: '.$maxHeap->count());
}

$maxHeap = new SplMaxHeap();
$maxHeap->insert('haha');
$maxHeap->insert('fsd');
$maxHeap->insert('test');
$maxHeap->insert('taha');
$maxHeap->insert('kaha');
$maxHeap->insert('paha');
while(!$maxHeap->isEmpty()){
    var_dump('top: ' . $maxHeap->extract());
    var_dump('count: '.$maxHeap->count());
}



