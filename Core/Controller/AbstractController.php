<?php
namespace PageViewer\Core\Controller;


use PageViewer\Core\Container\Container;
use PageViewer\Core\Http\RequestInterface;
use PageViewer\Core\Http\Response;
use PageViewer\Core\Router\Exception\NotFoundException;
use PageViewer\Core\ViewAdapter\ViewAdapterInterface;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ViewAdapterInterface
     */
    protected $view;

    /**
     * @var Container
     */
    protected $container;

    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function setViewAdapter(ViewAdapterInterface $view)
    {
        $this->view = $view;
    }

    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    public function render(string $viewName, array $params = []): Response
    {
        return new Response($this->view->render($viewName, $params));
    }

    public function notFound()
    {
        throw new NotFoundException();
    }
}