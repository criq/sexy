<?php

namespace Sexy;

class FncTrim extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('trim'), $arguments, $alias);
	}
}
