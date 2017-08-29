<?php
namespace PageViewer\Model\Page\Parser;


use PageViewer\Model\String\Regex;
use PageViewer\Model\String\Text;

class EmailParser implements ParserInterface
{
    const EMAIL_REGEX = '/[a-zA-Z0-9\.!\#\$\%\&\’\*\+\/\=\?\^\_\`\{\|\}\~\-]+\@[a-zA-Z0-9\-]+(?:\.[a-zA-Z0-9\-]+)*/';
    const REPLACEMENT = '<a href="mailto:$0">$0</a>';

    public function parse(Text $text): Text
    {
        $text = $text->replaceRegex(new Regex(self::EMAIL_REGEX), self::REPLACEMENT);

        return $text;
    }
}