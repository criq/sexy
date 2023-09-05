<?php

namespace Sexy;

class FncRand extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("rand"), $arguments, $alias);
	}
}
