<?php

namespace Sexy;

class AsAlias extends Expression {

	public $expression;
	public $alias;

	public function __construct(Expression $expression, Alias $alias) {
		$this->expression = $expression;
		$this->alias      = $alias;
	}

	public function getSql(&$context = []) {
		return " " . $this->expression->getSql($context) . " AS " . $this->alias->getSql($context) . " ";
	}

}
