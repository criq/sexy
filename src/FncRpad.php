<?php

namespace Sexy;

class FncRpad extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("rpad"), $arguments, $alias);
	}
}
