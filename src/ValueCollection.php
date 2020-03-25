<?php

namespace Sexy;

class ValueCollection extends Expression
{
	public $values = [];

	public function add($value)
	{
		$this->values[] = $value;
	}

	public function getSql(&$context = [])
	{
		$items = [];
		foreach ($this->values as $value) {
			$items[] = $value->getSql($context);
		}

		return implode(", ", $items);
	}
}
