<?php

namespace Sexy;

class CmpWhen extends Expression {

	public $value;
	public $result;

	public function __construct($value, $result) {
		$this->value  = $value instanceof Expression ? $value : new BindValue($value);
		$this->result = $result instanceof Expression ? $result : new BindValue($result);
	}

	public function getSql(&$context = []) {
		$sql = " WHEN " . $this->value->getSql($context) . " THEN " . $this->result->getSql($context);

		return $sql;
	}

}
