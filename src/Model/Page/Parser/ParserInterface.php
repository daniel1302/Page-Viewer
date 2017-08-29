<?php
namespace PageViewer\Model\Page\Parser;


use PageViewer\Model\String\Text;

interface ParserInterface
{
    public function parse(Text $text) : Text;
}