<?php
namespace PageViewer\Core\Router;


use PageViewer\Core\Collection\Collection;
use PageViewer\Core\Collection\CollectionInterface;
use PageViewer\Core\Controller\ControllerInterface;
use PageViewer\Core\Http\RequestInterface;
use PageViewer\Core\Router\Exception\RouterException;

class StandardRouter implements RouterInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var CollectionInterface
     */
    private $routes;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
        $this->routes  = new Collection();
    }

    public function registerRoute(Route $route) : void
    {
        if (isset($this->routes[$route->getName()])) {
            throw RouterException::forDuplicate($route->getName());
        }

        $this->routes[$route->getName()] = $route;
    }

    public function matchRoute(): ControllerInterface
    {
        $query = $this->request->getQuery();

        $routeName = $query->get('page', RouterInterface::INDEX_ROUTE);
        var_dump($routeName);
        die();
    }


}