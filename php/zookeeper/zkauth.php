<?php

/**
 * Simple Description file zkauth.php
 * 
 * Complete Description of  zkauth.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-3 10:44:41
 */
$ip = "1.1.1.1:3181";
$zok = new Zookeeper($ip);

$params = array(
    array(
        'perms' => Zookeeper::PERM_ALL,
        'scheme' => 'digest',
        'id' => 'admin:x1nq8J5GOJVPY6zgzhtTtA9izLc=',//admin
    ),
    array(
        'perms' => Zookeeper::PERM_READ,
        'scheme' => 'digest',
        'id' => 'read:jae2PDfjKwS9fvgyFYbcfj8UvJU=',//read
    ),
);
//$r1 = $zok->create('/test','test',$params);//string(5) "/test"  

$data = array(
    'key' => 'haha',
    'val' => rand(1, 1000),
    'arr' => array(array(1, 2, 3), array(5, 6, 7)),
);
var_dump($zok->get("/test"));//NULL
var_dump($zok->addAuth('digest', 'read:read'));//bool(true)
var_dump($zok->get("/test"));//string(4) "test"
var_dump($zok->set("/test", json_encode($data)));//NULL
var_dump($zok->get("/test"));//string(4) "test"
var_dump($zok->addAuth('digest', 'admin:admin'));//bool(true)
var_dump($zok->set("/test", json_encode($data)));//bool(true)
var_dump($zok->get("/test"));//string(48) "{"key":"haha","val":664,"arr":[[1,2,3],[5,6,7]]}"


//var_dump(get_class_methods("Zookeeper"));
//var_dump(get_class_vars("Zookeeper"));