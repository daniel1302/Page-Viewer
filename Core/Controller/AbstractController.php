<?php
namespace PageViewer\Core\Controller;


use PageViewer\Core\Http\RequestInterface;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }
}