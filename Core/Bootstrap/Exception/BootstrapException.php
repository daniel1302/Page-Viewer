<?php
namespace PageViewer\Core\Bootstrap\Exception;

use Exception;
use Throwable;


class BootstrapException extends Exception
{
    const CODE_UNDEFINED_DB_PARAMS = 100;


    public static function forUndefinedDbParams(Throwable $prev = null) : BootstrapException
    {
        return new self(
            'Database config is not initialized',
            self::CODE_UNDEFINED_DB_PARAMS,
            $prev
        );
    }
}