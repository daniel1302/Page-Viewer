<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 28.08.17
 * Time: 22:30
 */

namespace PageViewer\Core\Config\Adapter;


class AdapterFactory
{
    public static function createForIniFile(string $path): ConfigAdapterInterface
    {
        return new IniConfigAdapter($path);
    }
}