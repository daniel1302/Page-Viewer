<?php
namespace PageViewer\Core\Validator;


abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var mixed
     */
    protected $validatedValue;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $errors;


    public function __construct($value, array $options = [])
    {
        $this->validatedValue = $value;
        $this->options = $options;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function addError($error)
    {
        $this->errors[] = $error;
    }
}