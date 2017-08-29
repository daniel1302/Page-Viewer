<?php
namespace PageViewer\Core\Router;

use ArrayObject;
use PageViewer\Core\Router\Exception\RouteException;
use PageViewer\Core\Validator\RegexValidator;

final class Route
{
    const DEFAULT_REGEX = '.*?';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var string
     */
    private $method;

    /**
     *  { {'name': 'regex'}, {'name': 'regex'}, ... }
     *
     * @var ArrayObject
     */
    private $params;

    public function __construct(string $name, string $controllerName, string $method, array $params = [])
    {
        $this->name = $name;
        $this->controllerName = $controllerName;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return ArrayObject
     */
    public function getParams(): ArrayObject
    {
        return $this->params;
    }




    private function setParams(array $params = [])
    {
        foreach ($params as $paramName => $paramRegex) {
            if (is_int($paramName)) {
                $this->params[$paramRegex] = self::DEFAULT_REGEX;
            } else {
                $validator = new RegexValidator($paramRegex);
                $validator->validate();

                if (!$validator->isValid()) {
                    throw RouteException::forInvalidParamRegex($this->name, $paramName, $paramRegex);
                }

                $this->params[$paramName] = $paramRegex;
            }
        }
    }


}