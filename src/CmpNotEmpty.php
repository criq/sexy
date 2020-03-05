<?php

namespace Sexy;

class CmpNotEmpty extends Cmp
{
	public function getSql(&$context = [])
	{
		return " NOT ( " . $this->name->getSql($context) . " = '' ) ";
	}
}
