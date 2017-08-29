<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 29.08.17
 * Time: 07:33
 */

namespace PageViewer\Entity;


class Link
{
    /**
     * @var string
     */
    private $link;

    /**
     * @var Page
     */
    private $page;

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link)
    {
        $this->link = $link;
    }

    /**
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }

    /**
     * @param Page $page
     */
    public function setPage(Page $page = null)
    {
        $this->page = $page;
    }


}