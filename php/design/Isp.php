<?php

/**
 * Simple Description file Isp.php
 * 
 * Interface Segregation Princeple ISP
 * 
 * @author      cloudysong <madcloudsong@foxmail.com>
 * @version     $Id$
 * @package     module
 * @subpackage  controller/view
 * @date        2014-12-24 13:27:32
 */

//定制服务的例子，每一个接口应该是一种角色，不多不少，不干不该干的事，该干的事都要干。
/**
 * 比如java有很多listener的接口，为什么不合并成一个大的listener接口？就是遵循ISP，将行为粒度细化，不会耦合过多的接口行为
 */