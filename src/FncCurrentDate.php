<?php

namespace Sexy;

class FncCurrentDate extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("current_date"), $arguments, $alias);
	}
}
