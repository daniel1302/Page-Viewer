<?php
namespace PageViewer\Controller;

use PageViewer\Core\Controller\AbstractController;
use PageViewer\Core\Http\Response;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        return new Response('aaaa');
    }

    public function contactAction()
    {
        return new Response('BBBB');
    }
}