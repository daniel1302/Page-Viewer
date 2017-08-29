<?php
namespace PageViewer\Controller;

use PageViewer\Core\Controller\AbstractController;
use PageViewer\Core\Http\Response;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('Page/index', []);
    }

    public function contactAction()
    {
        return new Response('BBBB');
    }
}