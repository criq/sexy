<?php

namespace Sexy;

class CmpCase extends Expression
{
	public $column;
	public $default;
	public $whens;

	public function __construct($column, $whens, $default = null)
	{
		$this->column = $column;
		$this->default = $default instanceof Expression ? $default : new Param($default);
		$this->whens = $whens;
	}

	public function getSql(&$context = [])
	{
		$sql = " CASE " . $this->column->getSql($context);
		foreach ($this->whens as $when) {
			$sql .= $when->getSql($context);
		}
		if (!is_null($this->default)) {
			$sql .= " ELSE " . $this->default->getSql($context);
		}
		$sql .= " END ";

		return $sql;
	}
}
