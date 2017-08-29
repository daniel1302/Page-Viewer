<?php
namespace PageViewer\Repository;


use PageViewer\Core\Db\Adapter\MysqlAdapter;
use PageViewer\Core\Db\Db;
use PageViewer\Entity\Link;

class LinkRepository
{
    /**
     * @var PageRepository
     */
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @return array
     */
    public function getList() : array
    {
        /** @var MysqlAdapter $db */
        $db = Db::getDefaultAdapter();

        $query = $db->query('SELECT link, page_id FROM link');

        $results = [];
        foreach ($query->fetchAll() as $row) {
            $link = new Link();
            $link->setLink($row['link']);
            $link->setPage($this->pageRepository->getById($row['page_id']));
            $results[] = $link;
        }


        return $results;
    }
}