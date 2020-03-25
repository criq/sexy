<?php

namespace Sexy;

class FindInSet extends Expression
{
	public $name;
	public $value;

	public function __construct(Expression $name, $value)
	{
		$this->name = $name;

		if ($value instanceof Expression) {
			$this->value = $value;
		} else {
			$this->value = new BindValue($value);
		}
	}

	public function getSql(&$context = [])
	{
		return " FIND_IN_SET( " . $this->value->getSql($context) . ", " . $this->name->getSql($context) . " ) > 0 ";
	}
}
