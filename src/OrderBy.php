<?php

namespace Sexy;

class OrderBy extends Expression {

	public $orderBy;
	public $direction;

	public function __construct($orderBy, $direction = 'ASC') {
		$this->orderBy = $orderBy;
		$this->direction = $direction;
	}

	public function getSql(&$context = array()) {
		return $this->orderBy->getSql($context) . " " . $this->direction;
	}

}
