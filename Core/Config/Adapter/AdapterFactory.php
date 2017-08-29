<?php
namespace PageViewer\Core\Config\Adapter;


class AdapterFactory
{
    public static function createForIniFile(string $path): ConfigAdapterInterface
    {
        return new IniConfigAdapter($path);
    }
}