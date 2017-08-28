<?php

namespace PageViewer\Core\Router;


interface RouteRegistryInterface
{
    public function register(): RouterInterface;
}