<?php
namespace PageViewer\Controller;


use PageViewer\Core\Controller\AbstractController;
use PageViewer\Model\Page\Finder\Finder;
use PageViewer\Model\Page\Parser\Parser;

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
        $pageName = $this->request->get('name');

        if ($pageName === null) {
            return $this->notFound();
        }

        /** @var Finder $service */
        $finderService = $this->container->get('page_finder');

        $page = $finderService->findByName($pageName);
        if ($page === null) {
            return $this->notFound();
        }

        /** @var Parser $parserService */
        $parserService = $this->container->get('page_parser');


        return $this->render('Page/view', [
            'item' => $parserService->parse($page)
        ]);
    }
}