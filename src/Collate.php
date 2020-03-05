<?php

namespace Sexy;

class Collate extends Expression
{
	public $collation;
	public $expression;

	public function __construct(Expression $expression, $collation)
	{
		$this->expression = $expression;
		$this->collation  = $collation;
	}

	public function getSql(&$context = [])
	{
		return " ( ( " . $this->expression->getSql($context) . " ) COLLATE " . $this->collation . " ) ";
	}
}
