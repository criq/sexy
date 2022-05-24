<?php

namespace Sexy;

class FncDate extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("date"), $arguments, $alias);
	}
}
