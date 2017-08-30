<?php

namespace Fooman\PhpunitPolyfill;

class Runner
{
    public function execute()
    {
        $startDir = getenv('PRE_BASE_DIR');
        if (empty($startDir)) {
            throw new \RuntimeException('PRE_BASE_DIR needs to be set');
        }
        \Pre\Plugin\addMacroPath(__DIR__ . "/../src/macros.yay");

        $directories = new \RecursiveDirectoryIterator($startDir);

        $files = new \RegexIterator(
            new \RecursiveIteratorIterator($directories), "/pre$/", \RegexIterator::MATCH
        );

        foreach ($files as $file) {
            $pre = $file->getRealPath();
            $php = preg_replace("/pre$/", "php", $pre);
            \Pre\Plugin\compile($pre, $php, $format = true, $comment = false);
        }
    }
}