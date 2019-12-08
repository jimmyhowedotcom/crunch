<?php namespace Crunch\Strategies\Phar;

use Phar;

class DefaultStrategy
{
	public function crunch($from, $to, $stub, $options = [])
	{
		// create phar
		$phar = new Phar($to);

		// creating our library using whole directory
		$phar->buildFromDirectory($from);

		$phar->setDefaultStub($stub, '/index.php');

		$phar->compress(Phar::GZ);
	}
}
