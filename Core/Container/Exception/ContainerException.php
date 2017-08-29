<?php
namespace PageViewer\Core\Container\Exception;

use Throwable;
use LogicException;
class ContainerException extends LogicException
{
    const CODE_DUPLICATE_EXCEPTION = 11;
    public static function forDuplicateService(string $serviceName, Throwable $prev = null): ContainerException
    {
        return new self(
            sprintf('Service %s exist in container and cannot be overwrite', $serviceName),
            self::CODE_DUPLICATE_EXCEPTION,
            $prev
        );
    }
}