<?php

namespace Sexy;

class FncTimestamp extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('timestamp'), $arguments, $alias);
	}
}
