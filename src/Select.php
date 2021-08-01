<?php

namespace Sexy;

class Select extends Command
{
	public function __construct(Expression $select = null)
	{
		if ($select) {
			$this->select(...func_get_args());
		}

		$this->setGetFoundRows(true);

		return $this;
	}

	public function setGetFoundRows(bool $value = true) : Select
	{
		$this->setFlag('getTotalRows', $value);

		return $this;
	}

	public function setGetDistinctRows(bool $value = true) : Select
	{
		$this->setFlag('getDistinctRows', $value);

		return $this;
	}

	public function setGetTotalOnly(bool $value = true) : Select
	{
		$this->setPage($value ? new Page(1, 1) : null);

		return $this;
	}

	public function getSql(&$context = []) : string
	{
		$sql = " SELECT ";

		if ($this->getFlag('getDistinctRows')) {
			$sql .= " DISTINCT ";
		}

		if ($this->getFlag('getTotalRows')) {
			$sql .= " SQL_CALC_FOUND_ROWS ";
		}

		if (count($this->getExpressions('select'))) {
			$sql .= $this->getExpressions('select')->getSql(", ", $context);
		} else {
			$sql .= " * ";
		}

		if (count($this->getExpressions('from'))) {
			$sql .= " FROM " . $this->getExpressions('from')->getSql(", ", $context);
		}

		if (count($this->getExpressions('join'))) {
			$sql .= $this->getExpressions('join')->getSql(" ", $context);
		}

		if (count($this->getExpressions('where'))) {
			$sql .= " WHERE " . $this->getExpressions('where')->getSql(" AND ", $context);
		}

		if (count($this->getExpressions('groupBy'))) {
			$sql .= " GROUP BY " . $this->getExpressions('groupBy')->getSql(", ", $context);
		}

		if (count($this->getExpressions('having'))) {
			$sql .= " HAVING " . $this->getExpressions('having')->getSql(" AND ", $context);
		}

		if (count($this->getExpressions('orderBy'))) {
			$sql .= " ORDER BY " . $this->getExpressions('orderBy')->getSql(", ", $context);
		}

		if ($this->getLimit()) {
			$sql .= $this->getLimit()->getSql($context);
		} elseif ($this->getPage()) {
			$sql .= " LIMIT " . $this->getPage()->getSql($context);
		}

		return $sql;
	}
}
