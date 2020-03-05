<?php

namespace Sexy;

class CmpGreaterThan extends Cmp
{
	public function getSql(&$context = [])
	{
		return " ( " . $this->name->getSql($context) . " > " . $this->value->getSql($context) . " ) ";
	}
}
