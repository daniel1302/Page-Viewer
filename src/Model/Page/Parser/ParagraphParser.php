<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 28.08.17
 * Time: 20:47
 */

namespace PageViewer\Model\Page\Parser;


use PageViewer\Model\String\Text;

class ParagraphParser implements ParserInterface
{
    const OPEN_TAG = '<p>';
    const CLOSE_TAG = '</p>';

    public function parse(Text $text): Text
    {
        $textCopy = clone $text;


        $opened = true;
        $emptyBefore = false;
        $textCopy = $textCopy->replaceLine(0, self::OPEN_TAG . $textCopy[0]);

        foreach ($text as $lineNum => $line) {
            if ($text->isLineEmpty($lineNum)) {
                $opened = false;
                $emptyBefore = true;
                $textCopy = $textCopy->replaceLine($lineNum-1, $textCopy[$lineNum-1] . self::CLOSE_TAG);
            } else {
                if ($emptyBefore === true) {
                    $textCopy = $textCopy->replaceLine($lineNum, self::OPEN_TAG . $line);
                }
                $emptyBefore = false;
            }
        }

        if ($opened === true) {
            $textCopy = $textCopy->replaceLine($textCopy->count() - 1, $textCopy[$textCopy->count() - 1]. self::CLOSE_TAG);
        }



        return $textCopy;
    }
}