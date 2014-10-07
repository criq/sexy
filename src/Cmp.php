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
		} elseif (is_array($value)) {
			$this->value = new BindValueCollection();
			foreach ($value as $v) {
				$this->value->add(new BindValue(NULL, $v));
			}
		} else {
			$this->value = new BindValue(NULL, $value);
		}
	}

}
