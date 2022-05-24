<?php

namespace Sexy;

class FncDateDiff extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("datediff"), $arguments, $alias);
	}
}
