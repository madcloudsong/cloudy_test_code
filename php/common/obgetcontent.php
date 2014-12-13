<?php

/**
 * Simple Description file obgetcontent.php
 * 
 * 使用ob_get_contents来获取指定文件的内容
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-11-26 10:35:01
 */
ob_clean();
ob_start();
if (rand(0, 1)) {
    include dirname(__FILE__) . "/ob1.php";
} else {
    include dirname(__FILE__) . "/ob2.php";
}
$ob_body = ob_get_contents();
ob_end_clean();
var_dump($ob_body);
