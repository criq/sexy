<?php

namespace Sexy;

class FncAbs extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("abs"), $arguments, $alias);
	}
}
