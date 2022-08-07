<?php

namespace Sexy;

class FncAvg extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("avg"), $arguments, $alias);
	}
}
