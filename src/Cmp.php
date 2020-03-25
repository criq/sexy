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

		// BindValueCollection.
		} elseif (is_array($value)) {
			$this->value = new BindValueCollection;
			foreach ($value as $v) {
				$this->value->add(new BindValue($v));
			}

		// BindValue.
		} else {
			$this->value = new BindValue($value);
		}
	}
}
