<?php declare(strict_types=1);

namespace TodoGenerator;

class FilePathList
{
    private $filePathList;
    // Absolute path or Relative path
    private $rootPath = './';

    public function __construct()
    {
        $rootPath = rtrim($this->rootPath, '/');
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
}
