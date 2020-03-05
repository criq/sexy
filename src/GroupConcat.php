<?php

namespace Sexy;

class GroupConcat extends Expression
{
	public $column;
	public $distinct;
	public $orderBy;
	public $separator;

	public function __construct(Expression $column, Expression $orderBy = null, $separator = null, $distinct = false)
	{
		$this->column    = $column;
		$this->orderBy   = $orderBy;
		$this->separator = $separator;
		$this->distinct  = $distinct;
	}

	public function getSql(&$context = [])
	{
		$sql = " GROUP_CONCAT( ";
		if ($this->distinct) {
			$sql .= " DISTINCT ";
		}
		$sql .=  $this->column->getSql($context);
		if ($this->orderBy) {
			$sql .= " ORDER BY " . $this->orderBy->getSql($context) . " ";
		}
		if ($this->separator) {
			$sql .= " SEPARATOR '" . $this->separator . "' ";
		}
		$sql .= " ) ";

		return $sql;
	}
}
