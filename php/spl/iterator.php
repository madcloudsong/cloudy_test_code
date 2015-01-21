<?php

/**
 * Simple Description file iterator.php
 * 
 * Complete Description of  iterator.php
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2015-1-21 15:04:13
 */
function print_caps(Iterator $iterator) {
    echo strtoupper($iterator->current()) . "\n";
    return TRUE;
}

$it = new ArrayIterator(array("Apples", "Bananas", "Cherries"));
iterator_apply($it, "print_caps", array($it));

var_dump(iterator_to_array($it));

var_dump(class_parents('SplStack'));

var_dump(class_implements('SplStack'));
