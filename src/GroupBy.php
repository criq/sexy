<?php

namespace Sexy;

class GroupBy extends Expression
{
	public $direction;
	public $groupBy;

	public function __construct(Expression $groupBy, Keyword $direction = null)
	{
		$this->groupBy = $groupBy;
		$this->direction = $direction;
	}

	public function getSql(&$context = [])
	{
		return $this->groupBy->getSql($context) . " " . (!is_null($this->direction) ? $this->direction->getSql($context) : null);
	}
}
