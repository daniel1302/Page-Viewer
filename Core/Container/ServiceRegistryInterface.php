<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 29.08.17
 * Time: 08:05
 */

namespace PageViewer\Core\Container;


interface ServiceRegistryInterface
{
    public function register(Container $container);
}