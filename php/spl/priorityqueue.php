<?php

/**
 * Simple Description file priorityqueue
 * 
 * Complete Description of  priorityqueue
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-21
 */

$queue = new SplPriorityQueue();
$queue->insert('zhaoyun', 99);
$queue->insert('guanyu', 95);
$queue->insert('zhangfei', 96);
$queue->insert('liubei', 77);
$queue->insert('lvbu', 99);
while(!$queue->isEmpty()) {
    var_dump($queue->extract());
}