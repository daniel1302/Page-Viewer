<?php
namespace PageViewer\Core\Http;


use PageViewer\Core\Collection\CollectionInterface;
use PageViewer\Core\Collection\ReadOnlyCollection;

final class Request
{
    /**
     * @var CollectionInterface
     */
    private $query;

    /**
     * @var CollectionInterface
     */
    private $request;

    private function __construct(array $_get, array $_post)
    {
        $this->query = new ReadOnlyCollection($_get);
        $this->request = new ReadOnlyCollection($_post);
    }

    public static function initFromGlobals()
    {
        return new self($_GET, $_POST);
    }

    public function getQuery(): CollectionInterface
    {
        return $this->query;
    }

    public function getRequest(): CollectionInterface
    {
        return $this->request;
    }
}