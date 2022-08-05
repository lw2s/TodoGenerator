<?php declare(strict_types=1);

namespace TodoGenerator;

use TodoGenerator\File;

class FileManager
{
    private $filePath;

    public function __construct($rootPath)
    {
        $rootPath = rtrim($rootPath, '/');
        $this->filePath = new FilePath($rootPath);
    }

    public function process()
    {
        $result = [];
        foreach ($this->filePath->getFilePathList() as $filepath) {
            $fileContents = file($filepath);
            foreach ($this->yieldContents($fileContents) as $line => $content) {
                if (strpos($content, '// TODO:') !== false) {
                    $result[] = [
                        'filepath' => $filepath,
                        'line' => $line,
                        'todo' => $content
                    ];
                }
            }
        }

        return $result;
    }

    private function yieldContents($fileContents)
    {
        foreach ($fileContents as $fileContent) {
            yield $fileContent;
        }
    }
}
