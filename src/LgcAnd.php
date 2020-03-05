<?php

namespace Sexy;

class LgcAnd extends Expression
{
	public $expressions = [];

	public function __construct(array $expressions)
	{
		$this->expressions = $expressions;
	}

	public function getSql(&$context = [])
	{
		return " ( " . implode(" AND ", array_map(function ($i) use (&$context) {
			return " ( " . $i->getSql($context) . " ) ";
		}, $this->expressions)) . " ) ";
	}
}
