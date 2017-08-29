<?php
namespace PageViewer\Model\Page\Finder;


interface PageFinderInterface
{
    public function getList(): array;
    public function doesExist(string $name);
    public function load(string $name);
}