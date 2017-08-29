<?php
namespace PageViewer\Core\View;

use SplFileInfo;
use View\RendererException;


final class Renderer
{
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

        return $output;
    }
}