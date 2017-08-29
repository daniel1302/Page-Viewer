<?php
namespace PageViewer\Event;


use PageViewer\Core\Container\Container;
use PageViewer\Core\Event\EventInterface;

class ExecutionTimeMeterStartEvent implements EventInterface
{
    private static $startTime = 0.0;


    public function fire(Container $container = null)
    {
        self::$startTime = microtime(true);

    }

    public static function getStartTime() : float
    {
        return self::$startTime;
    }
}