<?php
namespace PageViewer\Event;


use PageViewer\Core\Container\Container;
use PageViewer\Core\Event\EventInterface;

class ExecutionTimeMeterFinishEvent implements EventInterface
{
    public function fire(Container $container = null)
    {

        $finishTime = microtime(true);

        echo 'Execution time: '. round($finishTime - ExecutionTimeMeterStartEvent::getStartTime(), 5) . ' ms';
    }
}