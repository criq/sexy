<?php

namespace Sexy;

class CmpIn extends Cmp
{
	public function getSql(&$context = [])
	{
		return " ( " . $this->name->getSql($context) . " IN ( " . $this->value->getSql($context) . " ) ) ";
	}
}
