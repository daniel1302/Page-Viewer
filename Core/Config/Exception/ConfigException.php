<?php
namespace PageViewer\Core\Config\Exception;

use Exception;
use Throwable;


class ConfigException extends Exception
{
    const CODE_NON_EXISTING_KEY = 80;

    public static function forNonExistingKey(string $key, Throwable $prev = null) : ConfigException
    {
        return new self(
            sprintf('Key "%s" does not exists in config', $key),
            self::CODE_NON_EXISTING_KEY,
            $prev
        );
    }
}