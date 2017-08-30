# Bridging Phpunit 4 and 6

This is an attempt to be able run the same tests in a Phpunit 4 and 6 environment (Background: Magento 2.2 bumped Phpunit from 4.1 to 6.2). This is done through preprocessing files to the respective required syntax.

Write your tests for Phpunit 6 and use `.pre` as file extenison instead of `.php`. Preprocessing will then convert the `.pre` file into php either with the phpunit 6 syntax intact or a modified version if an older version of phpunit was able to be detected.

This project can also be downloaded as a phar from [here](https://fooman.github.io/phpunit-polyfill/phpunit-polyfill.phar).

Running the phar or the bin provided via `vendor/bin/phpunit-polyfill.php` when installed via Composer should be from your project's root folder.

Both accept as first argument the root test folder from which it will look recursively for `.pre` files. Defaults to `tests`. For example  
`phpunit-polyfill.phar dev/tests/unit`  or
`phpunit-polyfill.phar dev/tests/integration`

It's also possible to include this in your test `bootstrap.php` file:

```php
<?php
//tests/bootstrap.php
require (__DIR__.'/../vendor/autoload.php');

putenv("PRE_BASE_DIR=" . __DIR__);
$runner = new \Fooman\PhpunitPolyfill\Runner();
$runner->execute();
```

`PRE_BASE_DIR` is the base directory from which it will look recursively for `.pre` files