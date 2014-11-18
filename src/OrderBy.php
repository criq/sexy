<?php

namespace Sexy;

class OrderBy extends Expression {

	public $orderBy;
	public $direction;

	public function __construct($orderBy, $direction = "ASC") {
		$this->orderBy = $orderBy;
		$this->direction = $direction;
	}

	public function getSql(&$context = array()) {
		if (is_array($this->orderBy)) {
			$orderBys = [];
			foreach ($this->orderBy as $orderBy) {
				$orderBys[] = $orderBy->getSql($context);
			}
			$sql = implode(", ", $orderBys);
		} else {
			$sql = $this->orderBy->getSql($context) . " " . $this->direction;
		}

		return $sql;
	}

}
