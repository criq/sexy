<?php

namespace Sexy;

class FncUnixTimestamp extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('unix_timestamp'), $arguments, $alias);
	}
}
