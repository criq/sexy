<?php

namespace Sexy;

class LgcNot extends Expression
{
	public $expression;

	public function __construct(Expression $expression)
	{
		$this->expression = $expression;
	}

	public function getSql(&$context = [])
	{
		return " NOT ( " . $this->expression->getSql($context) . " ) ";
	}
}
