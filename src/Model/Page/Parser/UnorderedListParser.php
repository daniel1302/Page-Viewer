<?php
namespace PageViewer\Model\Page\Parser;

use PageViewer\Model\Dom\DomManipulator;
use PageViewer\Model\String\Regex;
use PageViewer\Model\String\Text;
use DOMDocument;
use DOMXPath;

class UnorderedListParser implements ParserInterface
{
    const LIST_REGEX = '/^\*/iU';

    public function parse(Text $text): Text
    {
        $dom = new DOMDocument();
        $dom->loadHTML($text->getHtmlUtf8Copy());

        $xPath = new DOMXPath($dom);
        $nodes = $xPath->query('//p');

        foreach ($nodes as $node) {
            $regex = new Regex(self::LIST_REGEX);

            if (!$regex->doesMatch($node->nodeValue)) {
                continue;
//                $matches = $regex->match($node->nodeValue);
//
//                $element = $dom->createElement('h1', $matches['title']);
//                $node->parentNode->replaceChild($element, $node);
            }

            $ul = $dom->createElement('ul');

            $listItemText = '';
            foreach (new Text($node->nodeValue) as $line) {
                if ($regex->doesMatch($line)) {
                    if (!empty($listItemText)) {
                        $ul->appendChild($dom->createElement('li', $listItemText));
                        $listItemText = '';
                    }
                }

                $listItemText .=  $regex->replace($line, '');
            }
            $ul->appendChild($dom->createElement('li', $listItemText));

            $node->parentNode->replaceChild($ul, $node);
        }


        $domManipulator  = new DomManipulator($dom->getElementsByTagName('body')[0]);

        $text = new Text($domManipulator->getInnerHTML());

        return $text;
    }
}