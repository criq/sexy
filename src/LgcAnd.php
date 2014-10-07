<?php

namespace Sexy;

class LgcAnd extends Expression {

	public $expressions = array();

	public function __construct($expressions) {
		$this->expressions = $expressions;
	}

	public function getSql(&$context = array()) {
		return implode(" AND ", array_map(function($i) use(&$context) {
			return " ( " . $i->getSql($context) . " ) ";
		}, $this->expressions));
	}

}
