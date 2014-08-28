<?php

<<<<<<< HEAD
namespace Sexy;

abstract class Cmp extends Expression {
=======
namespace Katu\Pdo\Expressions;

abstract class Cmp extends \Katu\Pdo\Expression {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

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
