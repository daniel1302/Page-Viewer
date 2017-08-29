<?php
namespace PageViewer\Model\Page\Finder;

use ArrayObject;


class Finder
{
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
}