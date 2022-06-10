<?php

namespace Sexy;

class FncConcatWs extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("concat_ws"), $arguments, $alias);
	}
}
