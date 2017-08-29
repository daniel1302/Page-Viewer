<?php
namespace PageViewer\Core\Controller;


use PageViewer\Core\Http\RequestInterface;
use PageViewer\Core\ViewAdapter\ViewAdapterInterface;

interface ControllerInterface
{
    public function setRequest(RequestInterface $request);
    public function setViewAdapter(ViewAdapterInterface $viewAdapter);
}