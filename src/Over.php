<?php

namespace Sexy;

class Over extends Expression
{
	public $expression;
	public $window;

	public function __construct(Expression $expression, Window $window = null)
	{
		$this->expression = $expression;
		$this->window = $window;
	}

	public function getSql(&$context = [])
	{
		return " " . $this->expression->getSql($context) . ($this->window ? " OVER ( " . $this->window->getSql($context) . " ) " : null);
	}
}
