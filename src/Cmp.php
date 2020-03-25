<?php

namespace Sexy;

abstract class Cmp extends Expression
{
	public $name;
	public $value;

	public function __construct(Expression $name, $value = null)
	{
		$this->name = $name;

		// Expression.
		if ($value instanceof Expression) {
			$this->value = $value;

		// ValueCollection.
		} elseif (is_array($value)) {
			$this->value = new ValueCollection;
			foreach ($value as $v) {
				$this->value->add(new Value($v));
			}

		// Value.
		} else {
			$this->value = new Value($value);
		}
	}
}
