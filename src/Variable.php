<?php

namespace Sexy;

class Variable extends Expression
{
	public $name;

	public function __construct($name = null)
	{
		$this->name = $name instanceof static ? $name->getName() : (string)$name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getSql(&$context = [])
	{
		return "@" . $this->name;
	}
}
