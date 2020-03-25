<?php

namespace Sexy;

class CmpBetween extends Cmp
{
	public $column;
	public $maxValue;
	public $minValue;

	public function __construct($column, $minValue, $maxValue)
	{
		$this->column  = $column;
		if ($minValue instanceof Expression) {
			$this->minValue = $minValue;
		} else {
			$this->minValue = new Param($minValue);
		}
		if ($maxValue instanceof Expression) {
			$this->maxValue = $maxValue;
		} else {
			$this->maxValue = new Param($maxValue);
		}
	}

	public function getSql(&$context = [])
	{
		return " ( " . $this->column->getSql($context) . " BETWEEN " . $this->minValue->getSql($context) . " AND " . $this->maxValue->getSql($context) . " ) ";
	}
}
