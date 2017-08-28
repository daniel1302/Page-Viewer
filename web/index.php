<?php
$path = __DIR__.'/..';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);


require_once __DIR__ . '/../Core/Autoloader.php';
spl_autoload_register('\Autoloader::register');


$bootstrap = new \PageViewer\Core\Bootstrap();
$bootstrap->init();

$routerRegistry = new \PageViewer\Resources\RouteRegistry($bootstrap->getRequest());

$bootstrap->registerRoutes($routerRegistry);

$bootstrap->fire();