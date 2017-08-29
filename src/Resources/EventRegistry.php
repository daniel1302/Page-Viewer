<?php
namespace PageViewer\Resources;

use PageViewer\Controller\IndexController;
use PageViewer\Controller\PageController;
use PageViewer\Core\Container\Container;
use PageViewer\Core\Event\Event;
use PageViewer\Core\Event\EventRegistryInterface;
use PageViewer\Core\Http\RequestInterface;
use PageViewer\Core\Router\Route;
use PageViewer\Core\Router\RouteRegistryInterface;
use PageViewer\Core\Router\RouterFactory;
use PageViewer\Core\Router\RouterInterface;
use PageViewer\Event\ExecutionTimeMeterFinishEvent;
use PageViewer\Event\ExecutionTimeMeterStartEvent;

class EventRegistry implements EventRegistryInterface
{
    public function register(Event $event): void
    {
        $event->register(
            EventRegistryInterface::BEFORE_INIT,
            new ExecutionTimeMeterStartEvent()
        );

        $event->register(
            EventRegistryInterface::AFTER_RENDER,
            new ExecutionTimeMeterFinishEvent()
        );
    }
}