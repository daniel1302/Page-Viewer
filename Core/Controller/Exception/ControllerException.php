<?php
namespace PageViewer\Core\Controller\Exception;

use Exception;
use PageViewer\Core\Http\RequestInterface;
use Throwable;

class ControllerException extends Exception
{
    const CODE_NOT_DECLARED_METHOD = 50;
    const CODE_INVALID_RESPONSE = 51;

    public static function forNotDeclaredMethod(string $controllerName, string $methodName, Throwable $prev = null) : ControllerException
    {
        return new self(
            sprintf('Method "%s" for controller "%s" is not declared', $methodName, $controllerName),
            self::CODE_NOT_DECLARED_METHOD,
            $prev
        );
    }

    public static function forInvalidResponse(string $controllerName, string $methodName, $given, Throwable $prev = null) : ControllerException
    {
        return new self(
            sprintf('Method "%s" for controller "%s" returned invalid type. Expected %s, %s given',
                $methodName,
                $controllerName,
                RequestInterface::class,
                is_object($given) ? get_class($given) : gettype($given)
            ),
            self::CODE_INVALID_RESPONSE,
            $prev
        );
    }
}