<?php

namespace Sexy;

class Alias extends Expression {

	public $alias;

	public function __construct($alias = null) {
		$this->alias = (string) $alias;
	}

	public function getSql(&$context = []) {
		return " `" . $this->alias . "` ";
	}

}
