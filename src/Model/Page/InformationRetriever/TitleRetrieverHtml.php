<?php
namespace PageViewer\Model\Page\InformationRetriever;

use DOMDocument;
use DOMXPath;

class TitleRetrieverHtml implements InformationRetrieverInterface, TitleRetriever
{
    public function parseContent(string $content): string
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML($content);

        $xPath = new DOMXPath($dom);

        $node = $xPath->query('//h1');

        if ($node->length < 1) {
            return TitleRetriever::UNDEFINED_TITLE;
        }

        return $node->item(0)->nodeValue;
    }
}