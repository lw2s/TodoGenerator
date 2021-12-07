<?php declare(strict_types=1);

namespace TodoGenerator;

use TodoGenerator\FileManager;
use TodoGenerator\View;

class TodoGenerator
{
    private $fileManager;
    private $view;

    public function __construct($rootPath)
    {
        $this->fileManager = new FileManager($rootPath);
        $this->view = new View();
    }

    public function run()
    {
        $contents = $this->fileManager->process();
        $this->view->render($contents);
    }
}
