<?php
namespace PageViewer\Model\Page\Parser;


interface LineByLineParserInterface
{
    public function parseLine(string $text) : string;
}