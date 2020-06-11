<?php

namespace Sexy;

class Limit extends Expression
{
	public $limit;
	public $offset;

	public function __construct(int $limit = null, int $offset = null)
	{
		$this->limit = $limit;
		$this->offset = $offset;
	}

	public function getSql(&$context = [])
	{
		return " LIMIT " . (!is_null($this->limit) ? $this->limit : '18446744073709551615') . (!is_null($this->offset) ? " OFFSET " . $this->offset : null);
	}
}
