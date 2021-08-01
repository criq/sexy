<?php

namespace Sexy;

class Set extends Expression
{
	public function __construct(array $expressions = [])
	{
		$this->expressions = $expressions;
	}

	public function getSql(&$context = [])
	{
		return implode(", ", array_map(function ($expression) use (&$context) {
			return $expression->getSql($context);
		}, $this->expressions));
	}
}
