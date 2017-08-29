<?php
namespace PageViewer\Model\Page\Parser;

use PageViewer\Model\Dom\DomManipulator;
use PageViewer\Model\String\Regex;
use PageViewer\Model\String\Text;
use DOMDocument;
use DOMXPath;

class HeadersParser implements ParserInterface
{
    const FIRST_HEADER_REGEX = '/\A(?\'title\'.*)?\n^(?:(?:\-|\=)++)\Z/uim';
    const SMALLER_HEADER_REGEX = '/^\040*(?\'size\'\#{2,6})\040*(?\'title\'.*?)$/iu';

    public function parse(Text $text): Text
    {

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML($text->getHtmlUtf8Copy());

        $xPath = new DOMXPath($dom);
        $nodes = $xPath->query('//p');

        foreach ($nodes as $node) {
            $regex = new Regex(self::FIRST_HEADER_REGEX);

            if ($regex->doesMatch($node->nodeValue)) {
                $matches = $regex->match($node->nodeValue);

                $element = $dom->createElement('h1', $matches['title']);
                $node->parentNode->replaceChild($element, $node);

            } else {
                $regex = new Regex(self::SMALLER_HEADER_REGEX);
                if ($regex->doesMatch($node->nodeValue)) {
                    $matches = $regex->match($node->nodeValue);

                    $element = $dom->createElement(sprintf('h%d', strlen($matches['size'])), $matches['title']);
                    $node->parentNode->replaceChild($element, $node);
                }
            }
        }


        $domManipulator  = new DomManipulator($dom->getElementsByTagName('body')[0]);

        $text = new Text($domManipulator->getInnerHTML());

        return $text;
    }
}