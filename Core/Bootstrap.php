<?php
namespace PageViewer\Core;


use PageViewer\Core\Controller\Exception\ControllerException;
use PageViewer\Core\Controller\ControllerInterface;
use PageViewer\Core\Http\Request;
use PageViewer\Core\Http\RequestInterface;
use PageViewer\Core\Http\ResponseInterface;
use PageViewer\Core\Router\Route;
use PageViewer\Core\Router\RouteRegistryInterface;
use PageViewer\Core\Router\RouterInterface;
use ReflectionClass;


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
        $route = $this->router->matchRoute();
        $controllerReflection = new ReflectionClass($route->getControllerName());
        $controller = $controllerReflection->newInstance();

        $this->injectParametersToController($controller);
        $this->fireMethod($route, $controllerReflection, $controller);
    }

    private function fireMethod(Route $route, ReflectionClass $class, ControllerInterface $controller)
    {
        if (!$class->hasMethod($route->getMethod())) {
            throw ControllerException::forNotDeclaredMethod($route->getControllerName(), $route->getMethod());
        }

        $response = $controller->{$route->getMethod()}();

        if (!($response instanceof ResponseInterface)) {
            throw ControllerException::forInvalidResponse($route->getMethod(), $route->getControllerName(), $response);
        }

        $response->send();
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function registerRoutes(RouteRegistryInterface $register)
    {
        $this->router = $register->register();
    }

    private function injectParametersToController(ControllerInterface $controller)
    {
        $controller->setRequest($this->request);
    }
}