<?php
namespace PageViewer\Model\Page\Finder;


use PageViewer\Entity\Link;
use PageViewer\Entity\Page;
use PageViewer\Repository\LinkRepository;

class DatabaseFinder implements PageFinderInterface
{
    /**
     * @var LinkRepository
     */
    private $repository;

    /**
     * @var Link[]
     */
    private $list;

    public function __construct(LinkRepository $linkRepository)
    {
        $this->repository = $linkRepository;
    }

    public function getList(): array
    {
        if (!empty($this->list)) {
            return $this->list;
        }

        $this->list = $this->repository->getList();

        return $this->list;
    }


    public function doesExist(string $name): bool
    {
        $this->getList();

        foreach ($this->list as $item) {
            if ($item->getLink() === $name) {
                return true;
            }
        }

        return false;
    }

    public function load(string $name)
    {
        $this->getList();

        foreach ($this->list as $item) {
            if ($item->getLink() === $name) {
                return $item->getPage();
            }
        }

        return null;
    }
}