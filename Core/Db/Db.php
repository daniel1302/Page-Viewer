<?php
namespace PageViewer\Core\Db;

use PageViewer\Core\Db\Adapter\DatabaseAdapter;

final class Db
{
    const DEFAULT = 'default';

    /**
     * @var DatabaseAdapter[]
     */
    private static $adapters = [];


    public static function setAdapter(DatabaseAdapter $adapter, string $type = self::DEFAULT) : void
    {
        self::$adapters[$type] = $adapter;
    }

    public static function getAdapter(string $type = self::DEFAULT) : DatabaseAdapter
    {
        if (!isset(self::$adapters[$type])) {
            throw DbException::forUndefinedAdapter($type);
        }


        return self::$adapters[$type];
    }

    public static function getDefaultAdapter() : DatabaseAdapter
    {
        return self::getAdapter(self::DEFAULT);
    }
}