<?php

namespace Sexy;

class FncMonth extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('month'), $arguments, $alias);
	}
}
