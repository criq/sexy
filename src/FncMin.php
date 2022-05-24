<?php

namespace Sexy;

class FncMin extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("min"), $arguments, $alias);
	}
}
