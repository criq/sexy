<?php

namespace Sexy;

class CmpWhen extends Expression
{
	public $result;
	public $value;

	public function __construct($value, $result)
	{
		$this->value  = $value instanceof Expression ? $value : new Value($value);
		$this->result = $result instanceof Expression ? $result : new Value($result);
	}

	public function getSql(&$context = [])
	{
		$sql = " WHEN " . $this->value->getSql($context) . " THEN " . $this->result->getSql($context);

		return $sql;
	}
}
