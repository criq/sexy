<?php

namespace Sexy;

class GroupConcat extends Expression {

	public $column;
	public $orderBy;
	public $separator;

	public function __construct(Expression $column, Expression $orderBy = null, $separator = null) {
		$this->column    = $column;
		$this->orderBy   = $orderBy;
		$this->separator = $separator;
	}

	public function getSql(&$context = []) {
		$sql = " GROUP_CONCAT( " . $this->column->getSql($context);
		if ($this->orderBy) {
			$sql .= " ORDER BY " . $this->orderBy . " ";
		}
		if ($this->separator) {
			$sql .= " SEPARATOR '" . $this->separator . "' ";
		}
		$sql .= " ) ";

		return $sql;
	}

}