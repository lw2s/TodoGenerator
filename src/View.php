<?php declare(strict_types=1);

namespace TodoGenerator;

class View
{
    public function render($contents)
    {
        foreach ($contents as $content) {
            echo '■ TODO ' . '(filename: ' . basename($content['filepath']) . ', line: ' . ($content['line'] + 1) . ")\n";
            $content['todo'] = str_replace('// TODO:', '', $content['todo']);
            $content['todo'] = trim($content['todo']);
            echo '> ' . $content['todo'] . "\n\n";
        }
    }
}
