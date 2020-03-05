<?php

namespace Sexy;

class FncRound extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('round'), $arguments, $alias);
	}
}
