<?php
namespace PageViewer\Model\String;

use ArrayObject;


class Text extends ArrayObject
{
    public function __construct(string $text)
    {
        $this->lines = parent::__construct(preg_split("/\r\n|\n|\r/", $text));
    }

    public function getTextCopy() : string
    {
        return implode(PHP_EOL, $this->getArrayCopy());
    }

    public function getHtmlUtf8Copy() : string
    {
        return mb_convert_encoding($this->getTextCopy(), 'HTML-ENTITIES', 'UTF-8');
    }

    public function getLine(int $i)
    {
        if (!isset($this->lines[$i])) {
            return null;
        }

        return $this->lines[$i];
    }

    public function removeLine(int $n) : Text
    {
        $text = clone $this;

        unset($text[$n]);

        return $text;
    }

    public function replaceLine(int $i, string $newLine) : Text
    {
        $text = clone $this;

        $text[$i] = $newLine;

        return $text;
    }

    public function replace(string $str, string $replacement) : Text
    {
        return new Text(str_replace($str, $replacement, $this->getTextCopy()));
    }

    public function replaceRegex(Regex $regex, string $replacements) : Text
    {
        $text = $this->getTextCopy();

        return new Text($regex->replace($text, $replacements));
    }

    public function isLineEmpty(int $i) : bool
    {
        return empty($this[$i]);
    }

    public function doesLineMatch(int $i, string $regex) : bool
    {
        return preg_match($this[$i], $regex);
    }
}