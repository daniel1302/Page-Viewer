<?php
namespace PageViewer\Model\Page\Parser;

use PageViewer\Model\Dom\DomManipulator;
use PageViewer\Model\String\Regex;
use PageViewer\Model\String\Text;
use DOMDocument;
use DOMElement;
use DOMXPath;
use DOMText;

class FirstHeaderParser implements ParserInterface
{
    const FIRST_HEADER_REGEX = '/\A(?\'title\'.*)?\n^(?:(?:\-|\=)++)\Z/Uim';
    const REPLACEMENT = '<h1>$1</h1>';

    public function parse(Text $text): Text
    {
        $dom = new DOMDocument();
        $dom->loadHTML($text->getTextCopy());

        $xPath = new DOMXPath($dom);

        $nodes = $xPath->query('//p');

        foreach ($nodes as $node) {
            $regex = new Regex(self::FIRST_HEADER_REGEX);

            if (!$regex->doesMatch($node->nodeValue)) {
                continue;
            }

            $matches = $regex->match($node->nodeValue);

            $element = $dom->createElement('h1', $matches['title']);
            $node->parentNode->replaceChild($element, $node);
        }


        $domManipulator  = new DomManipulator($dom->getElementsByTagName('body')[0]);

        $text = new Text($domManipulator->getInnerHTML());

        return $text;
    }

    private function isHeader(string $line) : bool
    {
        return preg_match('/^(-|=)+$/', $line);
    }
}