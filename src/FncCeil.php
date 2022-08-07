<?php

namespace Sexy;

class FncCeil extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("ceil"), $arguments, $alias);
	}
}
