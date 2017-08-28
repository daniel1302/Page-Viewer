<?php
namespace PageViewer\Core\Db;

use Exception;
use Throwable;


class DbException extends Exception
{
    const CODE_UNDEFINED_ADAPTER = 70;


    public static function forUndefinedAdapter(string $type, Throwable $prev = null): DbException
    {
        return new self(
            sprintf('Adapter "%s" is not defined', $type),
            self::CODE_UNDEFINED_ADAPTER,
            $prev
        );
    }
}