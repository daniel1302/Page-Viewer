<?php
namespace PageViewer\Core\Config;

use ArrayObject;
use PageViewer\Core\Config\Adapter\ConfigAdapterInterface;
use PageViewer\Core\Config\Exception\ConfigException;


final class Config
{
    private $params;

    public function __construct()
    {
        $this->params = new ArrayObject();
    }

    public function has(string $name)
    {
        return isset($this->params[$name]);
    }

    public function get(string $name)
    {
        if (!isset($this->params[$name])) {
            throw ConfigException::forNonExistingKey($name);
        }

        return $this->params[$name];
    }

    public function addParameter(string $name, string $value)
    {
        $this->params[$name] = $value;
    }

    public function parse(ConfigAdapterInterface $adapter)
    {
        foreach ($adapter->parse() as $key => $value) {
            if ($this->params->offsetExists($key)) {
                continue;
            }

            $this->params->offsetSet($key, $value);
        }
    }
}