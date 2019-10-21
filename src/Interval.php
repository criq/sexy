<?php

namespace Sexy;

class Interval extends Expression {

	public $value;
	public $unit;

	public function __construct(Expression $value, Keyword $unit) {
		$this->value = $value;
		$this->unit  = $unit;
	}

	public function getSql(&$context = []) {
		return " INTERVAL " . $this->value->getSql($context) . " " . $this->unit->getSql($context);
	}

}
