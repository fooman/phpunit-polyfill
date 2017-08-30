#!/usr/bin/env php
<?php

$file = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($file)) {
    throw new \Exception('Could not find autoload file. Check your composer installation.');
}
require_once($file);

try {
    $baseDir = rtrim(dirname(__DIR__), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

    $phar = Phar::running(false);
    if (!empty($phar)) {
        $baseDir = rtrim(getcwd(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }
    $testsDirInput = isset($argv[1]) ? $argv[1] : 'tests';
    $dir = $baseDir . $testsDirInput;
    putenv("PRE_BASE_DIR=" . $dir);

    //move existing .php_cs out of the way
    if (file_exists($baseDir . '.php_cs')) {
        rename($baseDir . '.php_cs', $baseDir . '.php_cs_deactivated');
    }

    $runner = new \Fooman\PhpunitPolyfill\Runner();
    $runner->execute();
} catch (\Exception $e) {
    file_put_contents('php://stderr', $e . PHP_EOL);
}

//restore .php_cs
if (file_exists($baseDir . '.php_cs_deactivated')) {
    rename($baseDir . '.php_cs_deactivated', $baseDir . '.php_cs');
}