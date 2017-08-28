<?php
namespace PageViewer\Core\Config\Adapter;

use ArrayObject;


interface ConfigAdapterInterface
{
    public function parse(): ArrayObject;
}