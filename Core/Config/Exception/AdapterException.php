<?php
namespace PageViewer\Core\Config\Exception;

use Exception;
use Throwable;

class AdapterException extends Exception
{
    const CODE_NON_READABLE = 90;

    public static function forNonReadableFile(string $filePath, Throwable $prev = null) : AdapterException
    {
        return new self(
            sprintf('File "%s" is not readable', $filePath),
            self::CODE_NON_READABLE,
            $prev
        );
    }
}