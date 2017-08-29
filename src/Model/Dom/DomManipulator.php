<?php
namespace PageViewer\Model\Dom;

use DOMNode;

class DomManipulator
{
    /**
     * @var DOMNode
     */
    private $node;


    public function __construct(DOMNode $node)
    {
        $this->node = $node;
    }

    public function getInnerHTML() : string
    {
        $innerHTML = '';
        $children  = $this->node->childNodes;

        foreach ($children as $child) {
            $innerHTML .= $this->node->ownerDocument->saveHTML($child);
        }

        return $innerHTML;
    }
}