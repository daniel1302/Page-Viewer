<?php
namespace PageViewer\Core\Http;


use PageViewer\Core\Collection\CollectionInterface;

interface RequestInterface
{
    public function getQuery(): CollectionInterface;

    public function getRequest(): CollectionInterface;
}