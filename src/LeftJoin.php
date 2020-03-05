<?php

namespace Sexy;

class LeftJoin extends Join
{
	public function getSql(&$context = [])
	{
		return " LEFT JOIN " . $this->join->getSql($context) . " ON ( " . $this->conditions->getSql($context) . " ) " . ($this->alias ? " AS " . $this->alias : null);
	}
}
