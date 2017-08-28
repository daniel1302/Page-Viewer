<?php
namespace PageViewer\Core\Collection;


use PageViewer\Core\Collection\Exception\ReadOnlyCollectionException;

class ReadOnlyCollection extends Collection
{

    public function add(string $name, $value)
    {
        throw ReadOnlyCollectionException::forAdd();
    }


    public function remove(string $name): bool
    {
        throw ReadOnlyCollectionException::forRemove();
    }
}