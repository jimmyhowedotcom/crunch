<?php

namespace Crunch;

use Phar;

class Compiler
{
	public function compile( $filename = "crunch.phar" )
	{
		/*
		 * Clean Up
		 */
		if ( file_exists($filename) )
		{
			unlink($filename);
		}
		if ( file_exists($filename . '.gz') )
		{
			unlink($filename . '.gz');
		}

		$phar = new Phar($filename);

		$phar->buildFromDirectory('src/');

		$phar->setDefaultStub('index.php', '/index.php');

		$phar->compress(Phar::GZ);

		echo "$filename successfully created";
	}
}
