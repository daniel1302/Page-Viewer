<?php
namespace PageViewer\Model\Page\Finder;


use PageViewer\Repository\LinkRepository;

class DatabaseFinder implements PageFinderInterface
{
    /**
     * @var LinkRepository
     */
    private $repository;


    public function __construct(LinkRepository $linkRepository)
    {
        $this->repository = $linkRepository;
    }

    public function getList(): array
    {
        $pages = [];

        $links = $this->repository->getList();

        return $links;
    }

    public function doesExist(string $name)
    {
        // TODO: Implement doesExist() method.
    }

    public function load(string $name)
    {
        // TODO: Implement load() method.
    }
}