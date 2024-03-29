#!/usr/bin/env php
<?php

$cwd = getcwd();

chdir(__DIR__ . '/../');

$ts = rtrim(shell_exec('git log -n1 --pretty=%ct HEAD'));

if ( ! is_numeric($ts) )
{
	echo 'Could not detect date using "git log -n1 --pretty=%ct HEAD"' . PHP_EOL;
	exit(1);
}

// Install with the current version to force it having the right ClassLoader version
// Install without dev packages to clean up the included classmap from phpunit classes
shell_exec('php bin/composer config autoloader-suffix ComposerPhar' . $ts);
shell_exec('php bin/composer install -q --no-dev');
shell_exec('php bin/composer config autoloader-suffix --unset');

chdir($cwd);

require __DIR__ . '/../src/bootstrap.php';

use Crunch\Compiler;

error_reporting(- 1);

ini_set('display_errors', 1);

try
{
	$compiler = new Compiler();

	$compiler->compile();
}
catch ( Exception $e )
{
	echo 'Failed to compile phar: [' . get_class($e) . '] ' . $e->getMessage() . ' at ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;

	exit(1);
}
