<?php

namespace Sexy;

class Alias extends Expression {

	public $alias;

	public function __construct($alias = null) {
		$this->alias = (string) $alias;
	}

	public function getSql(&$context = []) {
		return implode('.', array_map(function($i) {
			return "`" . $i . "`";
		}, explode('.', trim($this->alias, "`"))));
	}

}
