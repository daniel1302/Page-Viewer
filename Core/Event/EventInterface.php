<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 29.08.17
 * Time: 14:37
 */

namespace PageViewer\Core\Event;


use PageViewer\Core\Container\Container;

interface EventInterface
{
    public function fire(Container $container = null);
}