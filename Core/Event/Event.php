<?php
namespace PageViewer\Core\Event;

use PageViewer\Core\Container\Container;

class Event
{
    /**
     * @var array
     */
    private $events = [];

    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container = null)
    {
        $this->container = $container;
    }

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }


    public function register(string $type, EventInterface $object)
    {
        if (!isset($this->events[$type])) {
            $this->events[$type] = [];
        }
        $this->events[$type][] = $object;
    }

    public function dispatch(string $type)
    {
        if (!isset($this->events[$type])) {
            return;
        }

        /** @var EventInterface $event */
        foreach ($this->events[$type] as $event) {
            $event->fire($this->container);
        }
    }
}