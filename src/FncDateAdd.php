<?php

namespace Sexy;

class FncDateAdd extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("date_add"), $arguments, $alias);
	}
}
