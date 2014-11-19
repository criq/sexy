<?php

namespace Sexy;

class Fn extends Expression {

	public $function;
	public $arguments;
	public $alias;

	public function __construct(Keyword $function, array $arguments, Alias $alias = NULL) {
		$this->function  = $function;
		$this->arguments = is_array($arguments) ? $arguments : [$arguments];
		$this->alias     = $alias;
	}

	public function getSql(&$context = []) {
		return " " . strtoupper($this->function) . "( " . implode(", ", $this->arguments) . " ) " . ($this->alias ? " AS " . $this->alias->getSql($context) : null);
	}

}
