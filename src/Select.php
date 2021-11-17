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

	public function setGetFoundRows(bool $value = true): Select
	{
		$this->setFlag('getTotalRows', $value);

		return $this;
	}

	public function setGetDistinctRows(bool $value = true): Select
	{
		$this->setFlag('getDistinctRows', $value);

		return $this;
	}

	public function setGetTotalOnly(bool $value = true): Select
	{
		$this->setPage($value ? new Page(1, 1): null);

		return $this;
	}

	public function setIntoOutfile(\Katu\Files\File $file, $fieldsTerminatedBy = ",", $optionallyEnclosedBy = '"', $escapedBy = '', $linesTerminatedBy = '\n'): Select
	{
		$this->setFlag('intoOutfile', (string)$file);
		$this->setFlag('fieldsTerminatedBy', (string)$fieldsTerminatedBy);
		$this->setFlag('optionallyEnclosedBy', (string)$optionallyEnclosedBy);
		$this->setFlag('escapedBy', (string)$escapedBy);
		$this->setFlag('linesTerminatedBy', (string)$linesTerminatedBy);

		return $this;
	}

	public function getSql(&$context = []): string
	{
		$sql = " SELECT ";

		if ($this->getFlag('getDistinctRows')) {
			$sql .= " DISTINCT ";
		}

		if ($this->getFlag('getTotalRows')) {
			$sql .= " SQL_CALC_FOUND_ROWS ";
		}

		if (count($this->getExpressions('select'))) {
			$sql .= $this->getExpressions('select')->setDelimiter(", ")->getSql($context);
		} else {
			$sql .= " * ";
		}

		if (count($this->getExpressions('from'))) {
			$sql .= " FROM " . $this->getExpressions('from')->setDelimiter(", ")->getSql($context);
		}

		if (count($this->getExpressions('join'))) {
			$sql .= $this->getExpressions('join')->setDelimiter(" ")->getSql($context);
		}

		if (count($this->getExpressions('where'))) {
			$sql .= " WHERE " . $this->getExpressions('where')->setDelimiter(" AND ")->getSql($context);
		}

		if (count($this->getExpressions('groupBy'))) {
			$sql .= " GROUP BY " . $this->getExpressions('groupBy')->setDelimiter(", ")->getSql($context);
		}

		if (count($this->getExpressions('having'))) {
			$sql .= " HAVING " . $this->getExpressions('having')->setDelimiter(" AND ")->getSql($context);
		}

		if (count($this->getExpressions('orderBy'))) {
			$sql .= " ORDER BY " . $this->getExpressions('orderBy')->setDelimiter(", ")->getSql($context);
		}

		if ($this->getLimit()) {
			$sql .= $this->getLimit()->getSql($context);
		} elseif ($this->getPage()) {
			$sql .= " LIMIT " . $this->getPage()->getSql($context);
		}

		if ($this->getFlag('intoOutfile')) {
			$sql .= " INTO OUTFILE `" . $this->getFlag('intoOutfile') . "` ";

			if ($this->getFlag('fieldsTerminatedBy')) {
				$sql .= " FIELDS TERMINATED BY `" . $this->getFlag('fieldsTerminatedBy') . "` ";
			}
			if ($this->getFlag('optionallyEnclosedBy')) {
				$sql .= " OPTIONALLY ENCLOSED BY `" . $this->getFlag('optionallyEnclosedBy') . "` ";
			}
			if ($this->getFlag('escapedBy')) {
				$sql .= " ESCAPED BY `" . $this->getFlag('escapedBy') . "` ";
			}
			if ($this->getFlag('linesTerminatedBy')) {
				$sql .= " LINES TERMINATED BY `" . $this->getFlag('linesTerminatedBy') . "` ";
			}
		}

		return $sql;
	}
}
