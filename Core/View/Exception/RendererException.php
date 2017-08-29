<?php
namespace View;

use Exception;
use Throwable;

class RendererException extends Exception
{
    const CODE_NON_EXISTING_FILE = 110;

    public static function forNonExistingFile(string $filePath, Throwable $prev = null) : RendererException
    {
        return new self(
            sprintf('View file "%s" does not exists', $filePath),
            self::CODE_NON_EXISTING_FILE,
            $prev
        );
    }
}