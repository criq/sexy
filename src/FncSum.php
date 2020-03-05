<?php

namespace Sexy;

class FncSum extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('sum'), $arguments, $alias);
	}
}
