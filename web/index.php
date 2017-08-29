<?php
$path = __DIR__.'/..';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);


require_once __DIR__ . '/../Core/Autoloader.php';
spl_autoload_register('\Autoloader::register');



$config = new \PageViewer\Core\Config\Config();
$config->parse(\PageViewer\Core\Config\Adapter\AdapterFactory::createForIniFile(__DIR__ .'/../src/Resources/config.ini.php'));

$viewDir = __DIR__ . '/../src/view';
$viewAdapter = new PageViewer\Core\ViewAdapter\StandardViewAdapter($viewDir, $viewDir.'/template.phtml');

$eventRegistry = new \PageViewer\Resources\EventRegistry();

$bootstrap = new \PageViewer\Core\Bootstrap\Bootstrap($config);
$eventRegistry->register($bootstrap->getEvent());

$bootstrap->init();
$bootstrap->initDb(\PageViewer\Core\Db\Adapter\MysqlAdapter::class);
$bootstrap->initView($viewAdapter);
$bootstrap->registerServices(new \PageViewer\Resources\ServiceRegistry());
$routerRegistry = new \PageViewer\Resources\RouteRegistry($bootstrap->getRequest());



$bootstrap->registerRoutes($routerRegistry);

$bootstrap->fire();

