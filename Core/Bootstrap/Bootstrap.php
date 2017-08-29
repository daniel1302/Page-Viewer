<?php
namespace PageViewer\Core\Bootstrap;


use PageViewer\Core\Bootstrap\Exception\BootstrapException;
use PageViewer\Core\Config\Config;
use PageViewer\Core\Container\Container;
use PageViewer\Core\Container\ServiceRegistryInterface;
use PageViewer\Core\Controller\AbstractController;
use PageViewer\Core\Controller\Exception\ControllerException;
use PageViewer\Core\Controller\ControllerInterface;
use PageViewer\Core\Db\Db;
use PageViewer\Core\Http\Request;
use PageViewer\Core\Http\RequestInterface;
use PageViewer\Core\Http\ResponseInterface;
use PageViewer\Core\Router\Route;
use PageViewer\Core\Router\RouteRegistryInterface;
use PageViewer\Core\Router\RouterInterface;
use PageViewer\Core\ViewAdapter\ViewAdapterInterface;
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

    /**
     * @var Config
     */
    private $config;

    /**
     * @var ViewAdapterInterface
     */
    private $viewAdapter;

    /**
     * @var Container
     */
    private $container;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function init() : void
    {
        $this->request = Request::initFromGlobals();
        $this->container = new Container();
    }

    public function initDb(string $dbAdapter): void
    {
        if (!$this->config->has('db_host')) {
            throw BootstrapException::forUndefinedDbParams();
        }

        Db::setAdapter(new $dbAdapter($this->config->get('db_host'), $this->config->get('db_user'), $this->config->get('db_pass'), $this->config->get('db_name')));
    }

    public function initView(ViewAdapterInterface $view) : void
    {
        $this->viewAdapter = $view;
    }

    public function fire(): void
    {
        $route = $this->router->matchRoute();
        $controllerReflection = new ReflectionClass($route->getControllerName());
        /** @var AbstractController $controller */
        $controller = $controllerReflection->newInstance();

        if (!($controller instanceof ControllerInterface)) {
            throw BootstrapException::forInvalidControllerClass();
        }

        $controller->setViewAdapter($this->viewAdapter);
        $controller->setRequest($this->request);
        $controller->setContainer($this->container);

        $this->injectParametersToController($controller);
        $this->fireMethod($route, $controllerReflection, $controller);
    }

    private function fireMethod(Route $route, ReflectionClass $class, ControllerInterface $controller): void
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

    public function registerRoutes(RouteRegistryInterface $register) : void
    {
        $this->router = $register->register();
    }

    public function registerServices(ServiceRegistryInterface $registry) : void
    {
        $registry->register($this->container);
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    private function injectParametersToController(ControllerInterface $controller) : void
    {
        $controller->setRequest($this->request);
    }
}