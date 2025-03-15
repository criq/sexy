<?php

namespace Sexy;

class FncStrToDate extends Fnc
{
	public function __construct(array $arguments = [], ?Alias $alias = null)
	{
		return parent::__construct(new Keyword("STR_TO_DATE"), $arguments, $alias);
	}
}
