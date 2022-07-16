<?php declare(strict_types=1);

namespace TodoGenerator;

class FileManager
{
    private $filePathList;
    private $fileContents;

    public function __construct($rootPath)
    {
        $rootPath = rtrim($rootPath, '/');
        $this->filePathList = $this->extractFilePathList($rootPath);
    }

    private function extractFilePathList($dir)
    {
        $files = glob($dir . '/*');

        $filePathList = [];
        foreach ($files as $file) {
            if (is_file($file)) {
                $filePathList[] = $file;
            }

            if (is_dir($file)) {
                $filePathList = array_merge($filePathList, $this->extractFilePathList($file));
            }
        }

        return $filePathList;
    }

    public function getFilePathList()
    {
        return $this->filePathList;
    }

    public function getFileContents()
    {
        return $this->fileContents;
    }

    public function process()
    {
        $result = [];
        foreach ($this->getFilePathList() as $filepath) {
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
