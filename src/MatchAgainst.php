<?php

namespace Sexy;

class MatchAgainst extends Expression {

	public $match;
	public $against;
	public $modifier;

	public function __construct($match, $against) {
		$this->match = $match;

		if ($against instanceof Expression) {
			$this->against = $against;
		} else {
			$this->against = new BindValue(null, $against);
		}
	}

	public function getSql(&$context = []) {
		$sql  = " MATCH ";
		$sql .= implode(", ", array_map(function($i) use(&$context) {
			return $i->getSql($context);
		}, $this->match));
		$sql .= " AGAINST ( " . $this->against->getSql($context) . " " . $this->modifier . " ) ";

		return $sql;
	}

	public function setBooleanMode() {
		$this->modifier = " IN BOOLEAN MODE ";

		return $this;
	}

}
