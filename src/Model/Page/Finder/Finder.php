<?php
namespace PageViewer\Model\Page\Finder;

use ArrayObject;
use PageViewer\Core\Router\Exception\NotFoundException;
use PageViewer\Entity\Page;


class Finder
{
    /**
     * @var PageFinderInterface[]
     */
    private $finders = [];

    public function addFinder(PageFinderInterface $finder) {
        $this->finders[] = $finder;
    }

    public function getList()
    {
        $result = new ArrayObject();

        foreach ($this->finders as $finder) {

            foreach ($finder->getList() as $item) {
                $result->append($item);
            }
        }

        return $result;
    }

    public function findByName(string $name) : Page
    {
        foreach ($this->finders as $finder) {
            if ($finder->doesExist($name)) {
                return $finder->load($name);
            }
        }

        throw new NotFoundException();
    }
}