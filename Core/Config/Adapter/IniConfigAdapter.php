<?php
namespace PageViewer\Core\Config\Adapter;


use PageViewer\Core\Config\Exception\AdapterException;
use SplFileInfo;
use ArrayObject;

class IniConfigAdapter implements ConfigAdapterInterface
{
    /**
     * @var SplFileInfo
     */
    private $file;

    public function __construct(string $filePath)
    {
        $this->file = new SplFileInfo($filePath);

        if (!$this->file->isFile() || !$this->file->isReadable()) {
            throw AdapterException::forNonReadableFile($filePath);
        }
    }

    public function parse(): ArrayObject
    {
        $result = parse_ini_file($this->file->getPathname(), true);

        if ($result === false) {
            return new ArrayObject([]);
        }


        return new ArrayObject($result);
    }
}