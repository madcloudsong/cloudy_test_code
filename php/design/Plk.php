<?php

/**
 * Simple Description file Plk.php
 * 
 * Principle of Least Knowledge PLK
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-24 13:27:49
 */
/**
 * 如果两个类不必彼此直接通信，那么这两个类就不应当发生直接的相互作用。如果其中一个类需要调用另一个类的某一个方法的话，可以通过第三者转发这个调用。
      前提：在类的结构设计上，每一个类都应当尽量降低成员的访问权限。
      根本思想：强调了类之间的松耦合。类之间的耦合越弱，越有利于复用，一个处在弱耦合的类被修改，不会对有关系的类造成波及。
 */
//也叫迪米特法则。不要和陌生人说话，即一个对象应对其他对象有尽可能少的了解
//我的理解是当我使用另一个类的时候，不要有太多前提，比如先调哪个再调哪个，传进去的东西又可能被修改，又可能在某种情形下有特殊的交互。
//换句话说，类之间尽量少的耦合