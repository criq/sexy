<?php

namespace Sexy;

class FncGroupConcat extends Fnc {

	public function __construct($expressions, $orderBy = null, $separator = null, $distinct = null) {
		$this->expressions = $expressions;
		$this->orderBy = $orderBy;
		$this->separator = $separator;
		$this->distinct = $distinct;
	}

	public function getSql(&$context = []) {
		$sql = " GROUP_CONCAT( ";
		if ($this->distinct) {
			$sql .= " DISTINCT ";
		}
		$sql .= implode(", ", array_map(function($expression) use(&$context) {
			return $expression->getSql($context);
		}, $this->expressions));
		if ($this->orderBy) {
			$sql .= " ORDER BY " . $this->orderBy->getSql($context);
		}
		if ($this->separator) {
			$sql .= " SEPARATOR " . $this->separator->getSql($context);
		}
		$sql .= " ) ";

		return $sql;
	}

}
