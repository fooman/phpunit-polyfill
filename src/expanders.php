<?php

namespace Yay\DSL\Expanders;

use Yay\Engine;
use Yay\TokenStream;

/**
 * @param TokenStream $stream
 * @param Engine      $engine
 *
 * @return TokenStream
 */
function phpunitCodeSwitcher(TokenStream $stream, Engine $engine): TokenStream
{
    $baseDir = getcwd();
    $both = (string)$stream;
    list($oldPhpunit, $result) = explode('|', $both);

    if (class_exists('PHPUnit_Framework_TestCase')) {
        $result = $oldPhpunit;
    } elseif(file_exists("$baseDir".'/vendor/bin/phpunit')){
        $phpunitOutput = shell_exec ("$baseDir".'/vendor/bin/phpunit --version');
        $parts = explode(' ',$phpunitOutput);

        if(version_compare($parts[1],'6.0.0', '<')) {
            $result = $oldPhpunit;
        }
    }

    return TokenStream::fromSource(
        $result
    );
}
