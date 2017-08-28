<?php
namespace PageViewer\Core\Http;


class Response implements ResponseInterface
{
    private $content;


    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function send()
    {
        echo $this->content;
    }
}