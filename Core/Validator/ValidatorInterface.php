<?php
namespace PageViewer\Core\Validator;


interface ValidatorInterface
{
    public function validate() : void;

    public function isValid(): bool;

    public function __construct($value, array $options = []);
}