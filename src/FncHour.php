<?php

namespace Sexy;

class FncHour extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('hour'), $arguments, $alias);
	}
}
