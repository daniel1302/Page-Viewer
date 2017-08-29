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

    /**
     * @var array
     */
    private $list = [];

    function __construct($dir)
    {
        $this->dir = new DirectoryIterator($dir);
    }

    /**
     * @return Link[]
     */
    public function getList(): array
    {
        if (!empty($this->list)) {
            return $this->list;
        }

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

        $this->list = $result;

        return $result;
    }

    public function doesExist(string $name): bool
    {
        $this->getList();

        foreach ($this->getList() as $item) {
            if ($item->getLink() === $name) {
                return true;
            }
        }

        return false;
    }

    public function load(string $name)
    {
        $this->getList();

        foreach ($this->getList() as $item) {
            if ($item->getLink() === $name) {
                return $item->getPage();
            }
        }

        return null;
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