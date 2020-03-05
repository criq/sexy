<?php

namespace Sexy;

class FncJsonExtract extends Fnc
{
	public function __construct(array $arguments = [], Alias $alias = null)
	{
		return parent::__construct(new Keyword('json_extract'), $arguments, $alias);
	}
}
