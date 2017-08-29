<?php
namespace PageViewer\Model\Page\Parser;


use PageViewer\Model\String\Regex;
use PageViewer\Model\String\Text;

class UrlParser implements ParserInterface
{
    const URL_REGEX = '/([a-z]+\:\/\/.*?)\040+/';
    const REPLACEMENT = '<a href="$1">$1</a> ';


    public function parse(Text $text): Text
    {
        return $text->replaceRegex(new Regex(self::URL_REGEX), self::REPLACEMENT);
    }
}