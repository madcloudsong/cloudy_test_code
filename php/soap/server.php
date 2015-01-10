<?php

/**
 * Simple Description file Server
 * 
 * Complete Description of  Server
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-1-11
 */
include 'Player.php';
$s = new SoapServer(null,array("location"=>"http://localhost/php/soap/server.php","uri"=>"server.php"));
$s -> setClass("Player");
$s->handle();

