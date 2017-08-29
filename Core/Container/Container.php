<?php
namespace PageViewer\Core\Container;


use PageViewer\Core\Container\Exception\ContainerException;

class Container
{
    const KEY_DEFINITION = 'definition';
    const KEY_OPTIONS    = 'options';

    /**
     * @var array
     */
    private static $registry = [];

    /**
     * Service definitions
     *
     * @var array
     */
    private static $definitions = [];

    /**
     * Container constructor.
     */
    public function __construct()
    {
    }

    /**
     * Allow to get to service via class property
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * Setter for dynammic services definitions
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        if (!is_numeric($key) && !is_string($key)) {
            throw new \InvalidArgumentException('Registry key for container must be number or string');
        }
        if (isset(self::$definitions[$key])) {
            throw new \InvalidArgumentException('You cannot overwrite hardcoded service');
        }
        self::$registry[$key] = $value;
    }
    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset(self::$registry[$key]) || isset(self::$definitions[$key]);
    }
    /**
     * Function gets service object if exists otherwise create from definition.
     * If definition is not exists InvalidArgumentException is throws
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if (!isset(self::$registry[$key]) && !isset(self::$definitions[$key])) {
            throw new \InvalidArgumentException('You are trying to get non-existing service '.$key);
        }
        if (!isset(self::$registry[$key])) {
            $callback = self::$definitions[$key][self::KEY_DEFINITION];
            $service = $callback($this);

            self::$registry[$key] = $service;

            return $service;
        }
        return self::$registry[$key];
    }

    /**
     * Add definition to container
     *
     * @param $serviceName
     * @param $callback
     * @throws ContainerException
     */
    public static function addDefinition($serviceName, $callback, array $options = [])
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('Creator must be callable');
        };
        if (isset(self::$definitions[$serviceName])) {
            throw ContainerException::forDuplicateService($serviceName);
        }
        self::$definitions[$serviceName][self::KEY_DEFINITION] = $callback;
    }

    public function getDefinitionNames()
    {
        return array_keys(self::$definitions);
    }
}