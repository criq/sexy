<?php

namespace Sexy;

class FncWeekday extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('weekday'), $arguments, $alias);
	}
}
