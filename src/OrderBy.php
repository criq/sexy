<?php

namespace Sexy;

class OrderBy extends Expression {

	public $orderBy;
	public $direction;

	public function __construct(Expression $orderBy, Keyword $direction = null) {
		$this->orderBy   = $orderBy;
		$this->direction = $direction;
	}

	public function getSql(&$context = []) {
		return $this->orderBy->getSql($context) . " " . ($this->direction ? $this->direction->getSql($context) : null);
	}

}
