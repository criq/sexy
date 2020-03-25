<?php

namespace Sexy;

abstract class Cmp extends Expression
{
	public $name;
	public $value;

	public function __construct(Expression $name, $value = null)
	{
		$this->name = $name;

		// Param.
		if ($value instanceof Param) {
			$this->value = $value;

		// Expression.
		} elseif ($value instanceof Expression) {
			$this->value = $value;

		// ParamCollection.
		} elseif (is_array($value)) {
			$this->value = new ParamCollection;
			foreach ($value as $v) {
				$this->value->add(new Param($v));
			}

		// Anything else.
		} else {
			$this->value = new Param((string)$value);
		}
	}
}
