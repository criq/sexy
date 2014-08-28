<?php

namespace Sexy;

class Fn extends Expression {

	public $function;
	public $arguments;
	public $alias;

	public function __construct($function, $arguments, $alias = NULL) {
		$this->function = $function;
		if (!is_array($arguments)) {
			$this->arguments = array($arguments);
		} else {
			$this->arguments = $arguments;
		}
		$this->alias = $alias;
	}

	public function getSql(&$context = array()) {
		$sql = " " . strtoupper($this->function) . "( " . implode(", ", $this->arguments) . " ) ";
		if ($this->alias) {
			$sql .= " AS " . $this->alias;
		}

		return $sql;
	}

}
