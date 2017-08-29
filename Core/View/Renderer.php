<?php
namespace PageViewer\Core\View;

use SplFileInfo;
use View\RendererException;


final class Renderer
{
    const BODY_BLOCK = '<%?BODY?%>';
    private $tplFile;

    public function __construct(string $tplFile = null)
    {
        $this->tplFile = $tplFile;
    }

    public function render(string $filePath, array $options) : string
    {
        $file = new SplFileInfo($filePath);

        if (!$file->isFile() || !$file->isReadable()) {
            RendererException::forNonExistingFile($filePath);
        }

        ob_start();
        extract($options);
        include $filePath;
        $output = ob_get_contents();
        ob_end_clean();

        if (!empty($this->tplFile)) {
            $file = new SplFileInfo($this->tplFile);

            if (!$file->isFile() || !$file->isReadable()) {
                RendererException::forNonExistingFile($this->tplFile);
            }

            ob_start();
            extract($options);
            include $this->tplFile;
            $outputTpl = ob_get_contents();
            ob_end_clean();

            return str_replace(self::BODY_BLOCK, $output, $outputTpl);
        }

        return $output;
    }
}