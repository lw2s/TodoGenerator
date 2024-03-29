<?php declare(strict_types=1);

namespace TodoGenerator;

use TodoGenerator\FileManager;
use TodoGenerator\FilePathList;
use TodoGenerator\View;

class TodoGenerator
{
    private $fileManager;
    private $view;

    public function __construct()
    {
        $this->fileManager = new FileManager();
        $this->view = new View();
    }

    public function run()
    {
        $this->fileManager->process(new FilePathList());
        $this->view->render($this->fileManager->getFileContents());
    }
}
