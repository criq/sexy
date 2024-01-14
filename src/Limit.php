<?php

namespace Sexy;

class Limit extends Expression
{
	public $limit;
	public $offset;

	public function __construct(?int $limit = null, ?int $offset = null)
	{
		$this->setLimit($limit);
		$this->setOffset($offset);
	}

	public function setLimit(?int $limit): Limit
	{
		$this->limit = $limit;

		return $this;
	}

	public function getLimit(): ?int
	{
		return $this->limit;
	}

	public function setOffset(?int $offset): Limit
	{
		$this->offset = $offset;

		return $this;
	}

	public function getOffset(): ?int
	{
		return $this->offset;
	}

	public function getSql(&$context = [])
	{
		return " LIMIT " . (!is_null($this->getLimit()) ? $this->getLimit() : "18446744073709551615") . (!is_null($this->getOffset()) ? " OFFSET " . $this->getOffset() : null);
	}
}
