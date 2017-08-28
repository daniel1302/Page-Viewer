<?php
namespace PageViewer\Core\Collection;

use Iterator;
use ArrayAccess;

interface CollectionInterface extends Iterator, ArrayAccess
{
    public function add(string $name, $value);
    public function get(string $name);
    public function count() : int;
    public function remove(string $name);
}