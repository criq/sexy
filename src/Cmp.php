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

		// ParamCollection.
		} elseif (is_array($value)) {
			$this->value = new ParamCollection;
			foreach ($value as $v) {
				$this->value->add(new Param($v));
			}

		// Value.
		} else {
			$this->value = new Param($value);
		}
	}
}
