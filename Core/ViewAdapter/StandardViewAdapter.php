<?php
namespace PageViewer\Core\ViewAdapter;


use PageViewer\Core\View\Renderer;

class StandardViewAdapter implements ViewAdapterInterface
{
    /**
     * @var Renderer
     */
    private $view;

    /**
     * @var string
     */
    private $viewDir;


    public function __construct(string $viewDir)
    {
        $this->view = new Renderer();
        $this->viewDir = $viewDir;
    }

    public function render(string $viewName, array $params = []): string
    {
        return $this->view->render($this->viewDir. '/' .$viewName.'.phtml', $params);
    }
}