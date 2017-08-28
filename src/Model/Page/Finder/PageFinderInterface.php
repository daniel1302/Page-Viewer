<?php
namespace PageViewer\Model\Finder;


interface PageFinderInterface
{
    public function getList(): array;
    public function doesExist(string $name);
    public function load(string $name);
}