<?php

namespace Sexy;

class FncUpper extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("upper"), $arguments, $alias);
	}
}
