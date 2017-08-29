<?php
namespace PageViewer\Model\Page\Finder;


use PageViewer\Entity\Page;

interface PageFinderInterface
{
    public function getList(): array;
    public function doesExist(string $name) : bool;
    public function load(string $name);
}