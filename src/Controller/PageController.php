<?php
namespace PageViewer\Controller;


use PageViewer\Core\Controller\AbstractController;
use PageViewer\Model\Page\Finder\Finder;

class PageController extends AbstractController
{
    public function indexAction()
    {
        /** @var Finder $service */
        $service = $this->container->get('page_finder');


        return $this->render('Page/index', [
            'list'  => $service->getList()
        ]);
    }


    public function viewAction()
    {
        $link = $this->request->get('name', null);
    }
}