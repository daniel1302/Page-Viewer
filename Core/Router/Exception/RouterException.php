<?php
namespace PageViewer\Core\Router\Exception;

use Exception;
use Throwable;


class RouterException extends Exception
{
    const CODE_DUPLICATE = 40;

    public static function forDuplicate(string $routeName, Throwable $prev = null) : RouterException
    {
        return new self(
            sprintf('Route "%s" is already registred. You cannot register two routes with same name.', $routeName),
            self::CODE_DUPLICATE,
            $prev
        );
    }
}