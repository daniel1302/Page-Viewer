<?php
$path = __DIR__.'/..';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);


require_once __DIR__ . '/../Core/Autoloader.php';
spl_autoload_register('\Autoloader::register');


$bootstrap = new \PageViewer\Core\Bootstrap();
$bootstrap->init();

//$bootstrap->registerRouter();


$a = ['a' => 'A', 'b' => 'B'];
$collection = new \PageViewer\Core\Collection\Collection($a);

foreach ($collection as $k => $v)
{
    var_dump($k, $v);
}