<?php

namespace Sexy;

class Select extends Command
{
	protected $getDistinctRows = false;
	protected $getTotalRows = true;

	public function __construct(Expression $select = null)
	{
		if ($select) {
			$this->select(...func_get_args());
		}

		return $this;
	}

	public function setGetFoundRows(bool $value = true) : Select
	{
		$this->getTotalRows = $value;

		return $this;
	}

	public function setGetDistinctRows(bool $value = true) : Select
	{
		$this->getDistinctRows = $value;

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

		if ($this->getDistinctRows) {
			$sql .= " DISTINCT ";
		}

		if ($this->getTotalRows) {
			$sql .= " SQL_CALC_FOUND_ROWS ";
		}

		if ($this->select) {
			$sql .= implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->select));
		} else {
			$sql .= " * ";
		}

		if ($this->from) {
			$sql .= " FROM " . implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->from));
		}

		if ($this->join) {
			$sql .= implode(" ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->join));
		}

		if ($this->where) {
			$sql .= " WHERE " . implode(" AND ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->where));
		}

		if ($this->groupBy) {
			$sql .= " GROUP BY " . implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->groupBy));
		}

		if ($this->having) {
			$sql .= " HAVING " . implode(" AND ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->having));
		}

		if ($this->orderBy) {
			$sql .= " ORDER BY " . implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->orderBy));
		}

		if ($this->limit) {
			$sql .= $this->limit->getSql($context);
		} elseif ($this->page) {
			$sql .= " LIMIT " . $this->page->getSql($context);
		}

		return $sql;
	}
}
