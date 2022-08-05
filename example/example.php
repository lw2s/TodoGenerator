<?php
require_once "../vendor/autoload.php";

use TodoGenerator\TodoGenerator;

$todoGenerator = new TodoGenerator();
$todoGenerator->run();
