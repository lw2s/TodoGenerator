<?php declare(strict_types=1);

namespace TodoGenerator;

class FilePath
{
    private $filePathList;

    public function __construct($rootpath)
    {
        $this->filePathList = $this->extractFilePathList($rootpath);
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
