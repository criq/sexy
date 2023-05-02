<?php

namespace Sexy;

class FncLpad extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("lpad"), $arguments, $alias);
	}
}
