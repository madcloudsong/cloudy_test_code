<?php

/**
 * Simple Description file eventsource
 * 
 * Complete Description of  eventsource
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-1-5
 */
set_time_limit(0);
header("content-type: text/event-stream");
echo "data:1\n\n";
$r = rand(1, 9999);
echo "event:testt\n\n";
$id = $_SERVER['HTTP_LAST_EVENT_ID'] + 1;
echo "id:$id\n\n";
echo "retry:1000\n\n";


if (false) {
    while (1) {
        echo 'data:time：' . date('H:i:s') . "\r\n\r\n";
        ob_flush();
        flush();
        sleep(1);
    };
}