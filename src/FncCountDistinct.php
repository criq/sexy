<?php

namespace Sexy;

class FncCountDistinct extends FncCount
{
	public function getSql(&$context = [])
	{
		return " " . trim(strtoupper($this->function->getSql($context))) . "( DISTINCT " . implode(", ", array_map(function ($i) use (&$context) {
			return $i->getSql($context);
		}, $this->arguments)) . " ) " . (!is_null($this->alias) ? " AS " . $this->alias->getSql($context) : null);
	}
}
