<?php

namespace Sexy;

class FncJsonContains extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('json_contains'), $arguments, $alias);
	}
}
