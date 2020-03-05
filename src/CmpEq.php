<?php

namespace Sexy;

class CmpEq extends Cmp
{
	public function getSql(&$context = [])
	{
		return " ( " . $this->name->getSql($context) . (!is_null($this->value) ? " = " . $this->value->getSql($context) : null) . " ) ";
	}
}
