<?php

namespace Sexy;

class FncConcat extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("concat"), $arguments, $alias);
	}
}
