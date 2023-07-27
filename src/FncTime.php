<?php

namespace Sexy;

class FncTime extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("time"), $arguments, $alias);
	}
}
