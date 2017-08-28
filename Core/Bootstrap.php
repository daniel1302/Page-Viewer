<?php
namespace PageViewer\Core;


use PageViewer\Core\Http\Request;
use PageViewer\Core\Http\RequestInterface;
use PageViewer\Core\Router\RouteRegistryInterface;
use PageViewer\Core\Router\RouterInterface;

/**
 * Implementation of Front Controller
 *
 * Class Bootstrap
 * @package PageViewer\Core
 */
final class Bootstrap
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var RouterInterface
     */
    private $router;

    public function init() : void
    {
        $this->request = Request::initFromGlobals();
    }

    public function fire()
    {
        $controller = $this->router->matchRoute();
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function registerRoutes(RouteRegistryInterface $register)
    {
        $this->router = $register->register();
    }
}