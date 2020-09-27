<?php

namespace Sexy;

class FncSubstr extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('substr'), $arguments, $alias);
	}
}
