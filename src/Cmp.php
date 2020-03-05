<?php

namespace Sexy;

abstract class Cmp extends Expression
{
	public $name;
	public $value;

	public function __construct(Expression $name, $value = null)
	{
		$this->name = $name;

		if ($value instanceof Expression) {
			$this->value = $value;
		} elseif (is_array($value)) {
			$this->value = new BindValueCollection();
			foreach ($value as $_value) {
				$this->value->add(new BindValue(null, $_value));
			}
		} else {
			$this->value = new BindValue(null, $value);
		}
	}
}
