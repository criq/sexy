<?php

namespace Sexy;

class CmpIsNull extends Expression {

	public function __construct(Expression $name) {
		$this->name = $name;
	}

	public function getSql(&$context = []) {
		return " ( " . $this->name->getSql($context) . " IS null ) ";
	}

}
