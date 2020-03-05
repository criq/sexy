<?php

namespace Sexy;

class FncMax extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('max'), $arguments, $alias);
	}
}
