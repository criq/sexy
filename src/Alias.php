<?php

namespace Sexy;

class Alias extends Expression {

	public $name;

	public function __construct($name) {
		$this->name = $name;
	}

	public function getSql(&$context = array()) {
		return $this->name;
	}

}
