<?php

namespace Sexy;

class FncCount extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('count'), $arguments, $alias);
	}
}
