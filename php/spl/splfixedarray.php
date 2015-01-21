<?php

/**
 * Simple Description file splfixedarray.php
 * 
 * Complete Description of  splfixedarray.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-1-21 11:21:54
 */
$array = new SplFixedArray(0);
var_dump($array->valid());
echo '<br/>';
$array = new SplFixedArray(10);
var_dump($array->valid());
echo '<br/>';
$array[1] = 5;
var_dump($array);
echo '<br/>';
var_dump($array->valid());
echo '<br/>';
var_dump($array[1]);
echo '<br/>';
var_dump($array[5]);
echo '<br/>';
var_dump($array->count());
echo '<br/>';
var_dump($array->getSize());
echo '<br/>';
var_dump($array->offsetGet(1));
echo '<br/>';
var_dump($array->toArray());
echo '<br/>';
var_dump($array->valid());
echo '<br/>';
var_dump($array->offsetExists(1));
echo '<br/>';
var_dump($array->offsetExists(2));
echo '<br/>';
foreach($array as $key => $value) {
    var_dump($key . ':' . $value);
}
echo '<br/>';
var_dump($array->setSize(20));
echo '<br/>';
var_dump($array->offsetSet(19, 'dsf'));
echo '<br/>';
var_dump($array->toArray());
echo '<br/>';
var_dump($array->setSize(10));
echo '<br/>';
var_dump($array->toArray());
echo '<br/>';
for($array->rewind(); $array->valid(); $array->next()) {
    var_dump($array->key(), ':', $array->current());
}


