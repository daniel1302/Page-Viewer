<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 29.08.17
 * Time: 09:00
 */

namespace PageViewer\Model\Page\InformationRetriever;


use PageViewer\Model\String\Regex;

class TitleRetrieverText implements InformationRetrieverInterface, TitleRetriever
{
    const KEY_TITLE = 'title';


    const TITLE_REGEX = '/(?\'title\'.*)?'
                        .'\n^(?:(?:\-|\=)+)$/Uim';

    public function parseContent(string $content): string
    {
        $regex = new Regex(self::TITLE_REGEX);
        $matches = $regex->match($content);

        if (!isset($matches[self::KEY_TITLE])) {
            return TitleRetriever::UNDEFINED_TITLE;
        }

        return $matches[self::KEY_TITLE];
    }
}