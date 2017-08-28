<?php
class Autoloader
{
    private static $psr4Mapping = [
        'PageViewer\\Core\\'      => 'Core/',
        'PageViewer'.'\\' => 'src/'
    ];

    public static function register(string $name) : void
    {
        $path = self::resolvePath($name);

        require_once($path);
    }

    protected static function resolvePath(string $name) : string
    {
        if (strpos($name, '_') !== false) {
            return self::getUnderLineResolvedPath($name);
        }

        return self::getNamespaceResolvedPath($name);
    }

    protected static function getUnderLineResolvedPath($name)
    {
        $namespace =  str_replace('_', '/', self::map($name)).'.php';
        $namespace = trim($namespace, '\\/');

        return $namespace;
    }

    protected static function getNamespaceResolvedPath($name)
    {
        $namespace =  str_replace('\\', '/', self::map($name)).'.php';
        $namespace = trim($namespace, '\\/');

        return $namespace;
    }

    protected static function map($namespace)
    {
        foreach (self::$psr4Mapping as $mapFrom => $mapTo) {
            if (strpos($namespace, $mapFrom) === 0) {
                $mapFrom = str_replace('\\', '\\\\', $mapFrom);
                $mapTo = str_replace('\\', '\\\\', $mapTo);


                $namespace = preg_replace('/^'.$mapFrom.'(.*)/', $mapTo.'$1', $namespace);
            }
        }

        return $namespace;
    }
}

