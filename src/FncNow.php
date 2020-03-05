<?php

namespace Sexy;

class FncNow extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('now'), $arguments, $alias);
	}
}
