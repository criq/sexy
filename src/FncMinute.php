<?php

namespace Sexy;

class FncMinute extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('minute'), $arguments, $alias);
	}
}
