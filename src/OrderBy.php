<?php

namespace Sexy;

class OrderBy extends Expression
{
	public $direction;
	public $orderBy;

	public function __construct(Expression $orderBy, Keyword $direction = null)
	{
		$this->orderBy   = $orderBy;
		$this->direction = $direction;
	}

	public function getSql(&$context = [])
	{
		return $this->orderBy->getSql($context) . " " . (!is_null($this->direction) ? $this->direction->getSql($context) : null);
	}
}
