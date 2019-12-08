<?php

namespace Crunch;

use Crunch\Strategies\DefaultStrategy;

class PharCruncher extends Cruncher
{
	private $strategy;

	public function crunch()
	{
		$this->strategy->crunch();
	}

	public function isValidDirectory( $from )
	{
		return is_dir($from);
	}

	public function using( DefaultStrategy $strategy )
	{
		return $strategy;
	}
}