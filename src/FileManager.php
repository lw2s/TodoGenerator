<?php declare(strict_types=1);

namespace TodoGenerator;

use TodoGenerator\FilePathList;

class FileManager
{
    private $fileContents;

    public function process(FilePathList $filePathList)
    {
        $result = [];
        foreach ($filePathList->getFilePathList() as $filepath) {
            $contents = file($filepath);
            foreach ($this->yieldContents($contents) as $line => $content) {
                if (strpos($content, '// TODO:') !== false) {
                    $result[] = [
                        'filepath' => $filepath,
                        'line' => $line,
                        'todo' => $content
                    ];
                }
            }
        }

        $this->fileContents = $result;
    }

    private function yieldContents($fileContents)
    {
        foreach ($fileContents as $fileContent) {
            yield $fileContent;
        }
    }

    public function getFileContents()
    {
        return $this->fileContents;
    }
}
