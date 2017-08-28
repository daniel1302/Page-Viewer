<?php
namespace PageViewer\Core\Router\Exception;

use Exception;
use Throwable;

class RouteException extends Exception
{
    const CODE_INVALID_REGEX = 30;

    public static function forInvalidParamRegex($routeName, string $paramName, string $paramRegex, Throwable $prev = null) : RouteException
    {
        return new self(
            sprintf('Error during creating route "%s". Regex "%s" for parameter "%s" is invalid', $routeName, $paramRegex, $paramName),
            self::CODE_INVALID_REGEX,
            $prev
        );
    }
}