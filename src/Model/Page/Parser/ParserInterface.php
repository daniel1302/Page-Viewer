<?php
namespace PageViewer\Model\Page\Parser;


interface ParserInterface
{
    public function parseLine(string $text) : string;
}