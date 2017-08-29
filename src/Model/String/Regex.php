<?php
namespace PageViewer\Model\String;


class Regex
{
    private $regex;

    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function match(string $string) : array
    {
        preg_match($this->regex, $string, $matches);

        return $matches;
    }

    public function matchAll(string $string) : array
    {
        preg_match_all($this->regex, $string, $matches);

        return $matches;
    }

    public function doesMatch(string $string): bool
    {
        return preg_match($this->regex, $string);
    }

    public function replace(string $string, string $replacement): string
    {
        return preg_replace($this->regex, $replacement, $string);
    }
}