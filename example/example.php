<?php
require_once "../vendor/autoload.php";

use TodoGenerator\TodoGenerator;

// Absolute path or Relative path
$rootPath = './';

$todoGenerator = new TodoGenerator($rootPath);

$todoGenerator->run();
