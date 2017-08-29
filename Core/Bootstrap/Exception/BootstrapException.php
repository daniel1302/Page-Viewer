<?php
namespace PageViewer\Core\Bootstrap\Exception;

use Exception;
use PageViewer\Core\Controller\ControllerInterface;
use Throwable;


class BootstrapException extends Exception
{
    const CODE_UNDEFINED_DB_PARAMS = 100;
    const CODE_INVALID_CONTROLLER_CLASS  = 101;

    public static function forUndefinedDbParams(Throwable $prev = null) : BootstrapException
    {
        return new self(
            'Database config is not initialized',
            self::CODE_UNDEFINED_DB_PARAMS,
            $prev
        );
    }

    public static function forInvalidControllerClass(Throwable $prev = null) : BootstrapException
    {
        return new self(
            sprintf('Controller class must be instance of %s', ControllerInterface::class),
            self::CODE_INVALID_CONTROLLER_CLASS,
            $prev
        );
    }
}