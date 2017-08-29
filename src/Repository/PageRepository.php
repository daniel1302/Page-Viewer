<?php
namespace PageViewer\Repository;


use ArrayObject;
use PageViewer\Core\Db\Adapter\MysqlAdapter;
use PageViewer\Core\Db\Db;
use PageViewer\Entity\Page;


class PageRepository
{
    private $cache = [];

    public function getById(int $id)
    {
        $this->collectRowsIfCacheIsEmpty();

        if (!isset($this->cache[$id])) {
            return null;
        }

        return $this->cache[$id];
    }

    private function collectRowsIfCacheIsEmpty()
    {
        if (!empty($this->cache)) {
            return;
        }

        /** @var MysqlAdapter $db */
        $db = Db::getDefaultAdapter();

        $query = $db->query('SELECT * FROM page');

        foreach ($query->fetchAll() as $row) {
            $page = new Page();
            $page->setMimeType($row['mime']);
            $page->setText($row['text']);
            $page->setTitle($row['title']);

            $this->cache[$row['id']] = $page;
        }
    }
}