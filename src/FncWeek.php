<?php

namespace Sexy;

class FncWeek extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('week'), $arguments, $alias);
	}
}
