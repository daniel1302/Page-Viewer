<?php
namespace PageViewer\Model\Page\Finder;


use DirectoryIterator;
use PageViewer\Entity\Link;
use PageViewer\Entity\Page;
use PageViewer\Model\Page\InformationRetriever\RetrieverFactory;
use PageViewer\Model\Page\InformationRetriever\TitleRetrieverHtml;
use SplFileInfo;
use SplFileObject;

class DirectoryFinder implements PageFinderInterface
{
    /**
     * @var string
     */
    private $dir;

    function __construct($dir)
    {
        $this->dir = new DirectoryIterator($dir);
    }

    public function getList(): array
    {
        $result = [];

        foreach ($this->dir as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }

            $link = new Link();
            $link->setLink($this->getFileName($fileInfo));

            $page = new Page();
            $link->setPage($page);

            if ($this->isHtmlFile($fileInfo)) {
                $page->setMimeType(Page::MIME_TYPE_HTML);
            } else {
                $page->setMimeType(Page::MIME_TYPE_TEXT);
            }

            $file = new SplFileObject($fileInfo->getPathname());
            $page->setText($file->fread($file->getSize()));

            $pageTitleRetriever = RetrieverFactory::createTitleRetriever($page);
            $page->setTitle($pageTitleRetriever->parseContent($page->getText()));


            $result[] = $link;
        }

        return $result;
    }

    public function doesExist(string $name)
    {
        // TODO: Implement doesExist() method.
    }

    public function load(string $name)
    {
        // TODO: Implement load() method.
    }

    private function isHtmlFile(SplFileInfo $file)
    {
        return $file->getExtension() === 'html';
    }

    public function getFileName(SplFileInfo $fileInfo)
    {
        $fileName = $fileInfo->getFilename();

        if (empty($fileInfo->getExtension())) {
            return $fileName;
        }

        return preg_replace(sprintf('/\.%s$/', $fileInfo->getExtension()), '', $fileName);
    }
}