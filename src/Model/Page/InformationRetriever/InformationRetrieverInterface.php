<?php
namespace PageViewer\Model\Page\InformationRetriever;


interface InformationRetrieverInterface
{
    public function parseContent(string $content): string;
}