<?php
namespace PageViewer\Core\Collection\Exception;

use Exception;
use Throwable;

class CollectionException extends Exception
{
    const CODE_DUPLICATE_ITEM = 10;
    const CODE_NON_EXISTING_ITEM = 11;

    public static function forDuplicateItem(string $name, Throwable $prev = null): CollectionException
    {
        return new self(
            sprintf('Collection contain already item "%s"', $name),
            self::CODE_DUPLICATE_ITEM,
            $prev
        );
    }

    public static function forNonExistingItem(string $name, Throwable $prev = null): CollectionException
    {
        return new self(
            sprintf('In collection is not contained item "%s"', $name),
            self::CODE_NON_EXISTING_ITEM,
            $prev
        );
    }
}