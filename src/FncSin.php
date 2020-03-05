<?php

namespace Sexy;

class FncSin extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('sin'), $arguments, $alias);
	}
}
