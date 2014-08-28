<?php

namespace Sexy;

abstract class Cmp extends Expression {

	public $name;
	public $value;

	public function __construct($name, $value = NULL) {
		$this->name = $name;

		if ($value instanceof BindValue) {
			$this->value = $value;
		} elseif ($value instanceof \Katu\Pdo\Column) {
			$this->value = $value;
		} else {
			$this->value = new BindValue(NULL, $value);
		}
	}

}
