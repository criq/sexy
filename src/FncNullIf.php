<?php

namespace Sexy;

class FncNullIf extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('nullif'), $arguments, $alias);
	}
}
