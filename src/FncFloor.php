<?php

namespace Sexy;

class FncFloor extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('floor'), $arguments, $alias);
	}
}
