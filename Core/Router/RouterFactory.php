<?php
namespace PageViewer\Core\Router;


use PageViewer\Core\Http\RequestInterface;

final class RouterFactory
{
    public function createStandardRouterFromRequest(RequestInterface $request) : RouterInterface
    {
        return new StandardRouter($request);
    }
}