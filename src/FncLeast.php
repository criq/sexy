<?php

namespace Sexy;

class FncLeast extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword("least"), $arguments, $alias);
	}
}
