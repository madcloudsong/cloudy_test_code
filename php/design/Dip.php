<?php

/**
 * Simple Description file Dip.php
 * 
 * Dependency Inversion Principle DIP
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-24 13:26:57
 */
/**
 * 抽象不应该依赖于细节，细节应当依赖于抽象。
要针对接口编程，而不是针对实现编程。
传递参数，或者在组合聚合关系中，尽量引用层次高的类。
主要是在构造对象时可以动态的创建各种具体对象，当然如果一些具体类比较稳定，就不必在弄一个抽象类做它的父类，这样有画蛇添足的感觉
 * 依赖倒置原则
A.高层次的模块不应该依赖于低层次的模块，他们都应该依赖于抽象。
B.抽象不应该依赖于具体，具体应该依赖于抽象。
 */

/**
 * 
 */
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

class Bow extends Weapon{
    public function who() {
        var_dump('I am Bow');
    }
}

class Hero{
    public function equipWeapon(Weapon $weapon) {
        $weapon->who();
    }
}

$sword = new Sword();
$bow = new Bow();
$hero = new Hero();
$hero->equipWeapon($sword);
$hero->equipWeapon($bow);
