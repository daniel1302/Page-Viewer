<?php
namespace PageViewer\Controller;


use PageViewer\Core\Controller\AbstractController;

class PageController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('Page/index');
    }

    public function viewAction()
    {
        $link = $this->request->get('page', null);
    }
}