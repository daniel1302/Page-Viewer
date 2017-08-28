<?php
namespace PageViewer\Core\Router;


use PageViewer\Core\Controller\ControllerInterface;

interface RouterInterface
{
    const INDEX_ROUTE = 'index';

    public function registerRoute(Route $route) : void;

    public function matchRoute() : ControllerInterface;
}