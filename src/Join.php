<?php

namespace Sexy;

class Join extends Expression
{
	public $alias;
	public $conditions;
	public $direction;
	public $join;

	public function __construct(Expression $join, Expression $conditions = null, Keyword $direction = null, Alias $alias = null)
	{
		$this->direction  = $direction;
		$this->join       = $join;
		$this->conditions = $conditions;
		$this->alias      = $alias;

		if ($this->join instanceof Select) {
			$this->join->setOptGetTotalRows(false);
		}
	}

	public function getSql(&$context = [])
	{
		return (!is_null($this->direction) ? $this->direction->getSql($context) : null) . " JOIN " . ($this->join instanceof Select ? " ( " : null) . $this->join->getSql($context) . " " . ($this->join instanceof Select ? " ) " : null) . " " . (!is_null($this->alias) ? " AS " . $this->alias->getSql($context) : null) . ($this->conditions ? " ON ( " . $this->conditions->getSql($context) . " ) " : null);
	}
}
