<?php
namespace PageViewer\Core\Event;


use PageViewer\Core\Container\Container;

interface EventRegistryInterface
{
    const BEFORE_INIT = 1;
    const AFTER_RENDER = 2;

    public function register(Event $event);
}