<?php

namespace Sexy;

class BindValueCollection extends Expression {

	public $values = array();

	public function add($value) {
		$this->values[] = $value;
	}

	public function getSql(&$context = array()) {
		$items = array();
		foreach ($this->values as $value) {
			$items[] = $value->getSql($context);
		}

		return implode(", ", $items);
	}

}
