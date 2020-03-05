<?php

namespace Sexy;

class Union extends Expression
{
	public $arguments;

	public function __construct($arguments = [])
	{
		$this->arguments = is_array($arguments) ? $arguments : [$arguments];
	}

	public function addArgument($argument)
	{
		return $this->arguments[] = $argument;
	}

	public function getSql(&$context = [])
	{
		$sqls = [];

		foreach ($this->arguments as $argument) {
			$sqls[] = " ( " . $argument->getSql($context) . " ) ";
		}

		return implode(" UNION ", $sqls);
	}
}
