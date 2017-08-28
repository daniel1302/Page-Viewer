<?php
namespace PageViewer\Core\Collection\Exception;

use Exception;
use Throwable;

class ReadOnlyCollectionException extends Exception
{
    const CODE_ADD = 20;
    const CODE_REMOVE = 21;

    public static function forAdd(Throwable $prev = null): ReadOnlyCollectionException
    {
        return new self(
            'Adding items to read-only collection is not allowed',
            self::CODE_ADD,
            $prev
        );
    }

    public static function forRemove(Throwable $prev = null): ReadOnlyCollectionException
    {
        return new self(
            'Removing items from read-only collection is not allowed',
            self::CODE_ADD,
            $prev
        );
    }

}