<?php

<<<<<<< HEAD
namespace Sexy;

class CmpIsNull extends Expression {
=======
namespace Katu\Pdo\Expressions;

class CmpIsNull extends \Katu\Pdo\Expression {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

	public function __construct($name) {
		$this->name = $name;
	}

	public function getSql(&$context = array()) {
		$sql = " ( " . $this->name->getSql($context) . " IS NULL ) ";

		return $sql;
	}

}
