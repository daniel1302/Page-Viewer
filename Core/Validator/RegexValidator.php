<?php
namespace PageViewer\Core\Validator;


class RegexValidator extends AbstractValidator
{
    const ERRORS = [
        PREG_NO_ERROR               => 'Code 0 : No errors',
        PREG_INTERNAL_ERROR         => 'Code 1 : There was an internal PCRE error',
        PREG_BACKTRACK_LIMIT_ERROR  => 'Code 2 : Backtrack limit was exhausted',
        PREG_RECURSION_LIMIT_ERROR  => 'Code 3 : Recursion limit was exhausted',
        PREG_BAD_UTF8_ERROR         => 'Code 4 : The offset didn\'t correspond to the begin of a valid UTF-8 code point',
        PREG_BAD_UTF8_OFFSET_ERROR  => 'Code 5 : Malformed UTF-8 data',
    ];

    public function validate(): void
    {
        preg_match(sprintf('/%s/', $this->validatedValue), 'bla bla bla');

        if (preg_last_error() !== PREG_NO_ERROR) {
            $this->addError(self::ERRORS[preg_last_error()]);
        }
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }
}