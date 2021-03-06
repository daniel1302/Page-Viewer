<?php
namespace PageViewer\Core\Router;


interface RouterInterface
{
    const INDEX_ROUTE = 'index';

    public function registerRoute(Route $route);

    public function matchRoute() : Route;
}