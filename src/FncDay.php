<?php

namespace Sexy;

class FncDay extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("day"), $arguments, $alias);
	}
}
