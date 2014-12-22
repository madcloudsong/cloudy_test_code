<?php

/**
 * Simple Description file FuncParamType
 * 
 * Complete Description of  FuncParamType
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-22
 */
function __autoload($classname) {
    $filename = "./". $classname .".php";
    include_once($filename);
}
function useWeapon(Weapon $weapon) {
    $weapon->attack();
}
function useSword(Sword $weapon) {
    $weapon->attack();
}
$weapon = new Weapon();
$sword = new Sword();

useWeapon($weapon);
useWeapon($sword);
useSword($sword);
useSword($weapon);
