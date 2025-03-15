<?php

namespace Sexy;

class FncStrToDatetime extends Fnc
{
	public function __construct(Expression $expression)
	{
		return parent::__construct(new Keyword("STR_TO_DATE"), [
			$expression,
			new Param("%Y-%m-%d %H:%i:%s"),
		]);
	}
}
