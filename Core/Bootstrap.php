<?php
namespace PageViewer\Core;



use PageViewer\Core\Http\Request;

/**
 * Implementation of Front Controller
 *
 * Class Bootstrap
 * @package PageViewer\Core
 */
final class Bootstrap
{
    /**
     * @var Request
     */
    private $request;

    public function init() : void
    {
        $this->request = Request::initFromGlobals();
    }
}