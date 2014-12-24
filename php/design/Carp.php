<?php

/**
 * Simple Description file Carp.php
 * 
 * Composite/Aggregate Reuse Principle CARP
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-24 13:27:38
 */
//合成/聚合复用原则（Composite/Aggregate Reuse Principle，CARP）经常又叫做合成复用原则。合成/聚合复用原则就是在一个新的对象里面使用一些已有的对象，使之成为新对象的一部分；新的对象通过向这些对象的委派达到复用已有功能的目的。它的设计原则是：要尽量使用合成/聚合，尽量不要使用继承。
/**
 * 就是说要少用继承，多用合成关系来实现。我曾经这样写过程序：有几个类要与数据库打交道，就写了一个数据库操作的类，然后别的跟数据库打交道的类都继承这个。结果后来，我修改了数据库操作类的一个方法，各个类都需要改动。“牵一发而动全身”！面向对象是要把波动限制在尽量小的范围。
在Java中，应尽量针对Interface编程，而非实现类。这样，更换子类不会影响调用它方法的代码。要让各个类尽可能少的跟别人联系，“不要与陌生人说话”。这样，城门失火，才不至于殃及池鱼。扩展性和维护性才能提高。
理解了这些原则，再看设计模式，只是在具体问题上怎么实现这些原则而已。张无忌学太极拳，忘记了所有招式，打倒了“玄冥二老”，所谓“心中无招”。设计模式可谓招数，如果先学通了各种模式，又忘掉了所有模式而随心所欲，可谓OO（Object-Oriented，面向对象）之最高境界。呵呵，搞笑，搞笑！
 */