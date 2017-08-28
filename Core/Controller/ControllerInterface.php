<?php
namespace PageViewer\Core\Controller;


use PageViewer\Core\Http\RequestInterface;

interface ControllerInterface
{
    public function setRequest(RequestInterface $request);
}