<?php

namespace Sexy;

class Join extends Expression {

	public $direction;
	public $join;
	public $conditions;
	public $alias;

	public function __construct(Expression $join, Expression $conditions, Keyword $direction = null, Alias $alias = null) {
		$this->direction  = $direction;
		$this->join       = $join;
		$this->conditions = $conditions;
		$this->alias      = $alias;

		if ($this->join instanceof Select) {
			$this->join->setOptGetTotalRows(false);
		}
	}

	public function getSql(&$context = []) {
		return ($this->direction ? $this->direction->getSql($context) : null) . " JOIN ( " . $this->join->getSql($context) . " ) " . ($this->alias ? " AS " . $this->alias->getSql($context) : null) . " ON ( " . $this->conditions->getSql($context) . " ) ";
	}

}
