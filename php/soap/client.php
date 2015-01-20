<?php

/**
 * Simple Description file client
 * 
 * Complete Description of  client
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-1-11
 */
$soap = new SoapClient(null,array('location'=>"http://localhost/php/soap/server.php",'uri'=>'server.php'));

$result1 = $soap->getName();
$result2 = $soap->__soapCall("getName",array());
$result3 = $soap->add(1, 2);
$result4 = $soap->__soapCall('add', array(1, 2));
$result5 = $soap->isGood();
echo $result1."<br/>";
echo $result2."<br/>";
echo $result3."<br/>";
echo $result4."<br/>";
var_dump($result5);
