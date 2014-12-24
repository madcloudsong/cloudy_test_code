<?php

/**
 * Simple Description file OpenClose.php
 * 
 * Open Closed Principle OCP
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-24 13:26:22
 */
//Software entities should be open for extension, but closed for modification.
//模块应该对扩展开放，对修改关闭
class Weapon{
    public function who(){
        var_dump('I am Weapon');
    }
}

class Sword extends Weapon{
    public function who() {
        var_dump('I am Sword');
    }
}

class WeaponFactory{
    /**
     * 
     * @param string $strWeapon
     * @return Weapon
     */
    public static function makeWeapon($strWeapon = 'Weapon') {
        $weapon = new $strWeapon();
        return $weapon;
    }
}

$sword = WeaponFactory::makeWeapon('Sword');
$sword->who();

$weapon = WeaponFactory::makeWeapon();
$weapon->who();


class Bow extends Weapon{
    public function who() {
        var_dump('I am Bow');
    }
}

$bow = WeaponFactory::makeWeapon('Bow');
$bow->who();


