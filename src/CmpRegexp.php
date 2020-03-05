<?php

namespace Sexy;

class CmpRegexp extends Cmp
{
	public function getSql(&$context = [])
	{
		return " ( " . $this->name->getSql($context) . " REGEXP " . $this->value->getSql($context) . " ) ";
	}
}
