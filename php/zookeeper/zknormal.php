<?php

/**
 * Simple Description file zknormal.php
 * 
 * Complete Description of  zknormal.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-3 10:46:49
 */
$ip = "1.1.1.1:3181";
$zok = new Zookeeper($ip);

//allow anyone to access
$params = array(
    array(
        'perms' => Zookeeper::PERM_ALL,
        'scheme' => 'world',
        'id' => 'anyone',
    )
);
$r1 = $zok->create('/test','test',$params);
var_dump($r1);//'/test'

$data = array(
    'key' => 'haha',
    'val' => rand(1, 1000),
    'arr' => array(array(1, 2, 3), array(5, 6, 7)),
);
var_dump($zok->get("/test"));
$r4 = $zok->set("/test", json_encode($data));
var_dump($zok->get("/test"));

//var_dump(get_class_methods("Zookeeper"));
//var_dump(get_class_vars("Zookeeper"));