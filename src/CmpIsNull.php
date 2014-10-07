<?php

namespace Sexy;

class CmpIsNull extends Expression {

	public function __construct($name) {
		$this->name = $name;
	}

	public function getSql(&$context = array()) {
		$sql = " ( " . $this->name->getSql($context) . " IS NULL ) ";

		return $sql;
	}

}
