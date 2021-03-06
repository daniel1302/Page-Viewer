<?php
namespace PageViewer\Resources;

use PageViewer\Controller\IndexController;
use PageViewer\Controller\PageController;
use PageViewer\Core\Http\RequestInterface;
use PageViewer\Core\Router\Route;
use PageViewer\Core\Router\RouteRegistryInterface;
use PageViewer\Core\Router\RouterFactory;
use PageViewer\Core\Router\RouterInterface;

class RouteRegistry implements RouteRegistryInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function register(): RouterInterface
    {
        $factory = new RouterFactory();
        $router = $factory->createStandardRouterFromRequest($this->request);


        $router->registerRoute(new Route(RouterInterface::INDEX_ROUTE, IndexController::class, 'indexAction'));
        $router->registerRoute(new Route('contact', IndexController::class, 'contactAction'));
        $router->registerRoute(new Route('page', PageController::class, 'indexAction'));
        $router->registerRoute(new Route('view-page', PageController::class, 'viewAction'));

        return $router;
    }
}