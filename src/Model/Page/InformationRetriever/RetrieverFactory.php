<?php
namespace PageViewer\Model\Page\InformationRetriever;


use PageViewer\Entity\Page;

class RetrieverFactory
{
    public static function createTitleRetriever(Page $page)
    {
        if ($page->getMimeType() === Page::MIME_TYPE_TEXT) {
            return new TitleRetrieverText();
        }

        return new TitleRetrieverHtml();
    }
}