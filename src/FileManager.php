<?php declare(strict_types=1);

namespace TodoGenerator;

class FileManager
{
    private $files;
    private $fileContents;

    public function __construct($rootPath)
    {
        $rootPath = rtrim($rootPath, '/');
        $this->files = $this->extractFilePathList($rootPath);
    }

    private function extractFilePathList($dir)
    {
        $files = glob($dir . '/*');

        $fileList = [];
        foreach ($files as $file) {
            if (is_file($file)) {
                $fileList[] = $file;
            }

            if (is_dir($file)) {
                $fileList = array_merge($fileList, $this->extractFilePathList($file));
            }
        }

        return $fileList;
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function setFileContents($filepath)
    {
        $this->fileContents = file($filepath);
    }

    public function getFileContents()
    {
        return $this->fileContents;
    }

    public function process()
    {
        $result = [];
        foreach ($this->getFiles() as $filepath) {
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
