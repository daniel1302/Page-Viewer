<?php
namespace PageViewer\Core\Router\Exception;

use Exception;
use Throwable;


class RouterException extends Exception
{
    const CODE_DUPLICATE = 40;
    const CODE_MISS_MATCH = 41;

    public static function forDuplicate(string $routeName, Throwable $prev = null) : RouterException
    {
        return new self(
            sprintf('Route "%s" is already registred. You cannot register two routes with same name.', $routeName),
            self::CODE_DUPLICATE,
            $prev
        );
    }

    public static function forMissMatch(Throwable $prev = null) : RouterException
    {
        return new self(
            'No page found',
            self::CODE_DUPLICATE,
            $prev
        );
    }

}