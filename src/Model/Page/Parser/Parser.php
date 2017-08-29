<?php
namespace PageViewer\Model\Page\Parser;


use PageViewer\Entity\Page;
use PageViewer\Model\String\Text;

class Parser
{
    /**
     * @var ParserInterface[]
     */
    private $lineByLineParser = [];

    public function parse(Page $page) : Page
    {
        if ($page->getMimeType() === Page::MIME_TYPE_HTML) {
            return $page;
        }

        $string = new Text($page->getText());


        foreach ($this->lineByLineParser as $parser) {
            $string = $parser->parse($string);
        }

        $page->setText($string->getTextCopy());
        return $page;
    }

    public function addParser(ParserInterface $parser)
    {
        $this->lineByLineParser[] = $parser;
    }
}