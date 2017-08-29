<?php
namespace PageViewer\Core\Validator;


interface ValidatorInterface
{
    public function validate();

    public function isValid(): bool;

    public function __construct($value, array $options = []);
}