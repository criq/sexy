<?php

namespace Sexy;

class CmpNotIn extends Cmp
{
	public function getSql(&$context = [])
	{
		return " ( " . $this->name->getSql($context) . " NOT IN ( " . $this->value->getSql($context) . " ) ) ";
	}
}
