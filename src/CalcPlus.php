<?php

namespace Sexy;

class CalcPlus extends Expression {

	public $arguments;

	public function __construct(array $arguments) {
		$this->arguments = is_array($arguments) ? $arguments : [$arguments];
	}

	public function getSql(&$context = []) {
		return " ( " . implode(" + ", array_map(function($i) use(&$context) {
			return $i->getSql($context);
		}, $this->arguments)) . " ) ";
	}

}
