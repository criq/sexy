<?php

namespace Sexy;

class FncLower extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('lower'), $arguments, $alias);
	}
}
