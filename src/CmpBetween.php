<?php

namespace Sexy;

class CmpBetween extends Cmp {

	public $column;
	public $minValue;
	public $maxValue;

	public function __construct($column, $minValue, $maxValue) {
		$this->column  = $column;
		if ($minValue instanceof Expression) {
			$this->minValue = $minValue;
		} else {
			$this->minValue = new BindValue($minValue);
		}
		if ($maxValue instanceof Expression) {
			$this->maxValue = $maxValue;
		} else {
			$this->maxValue = new BindValue($maxValue);
		}
	}

	public function getSql(&$context = []) {
		return " ( " . $this->column->getSql($context) . " BETWEEN " . $this->minValue->getSql($context) . " AND " . $this->maxValue->getSql($context) . " ) ";
	}

}
