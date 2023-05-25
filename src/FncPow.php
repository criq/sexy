<?php

namespace Sexy;

class FncPow extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("pow"), $arguments, $alias);
	}
}
