<?php

<<<<<<< HEAD
namespace Sexy;

class Alias extends Expression {
=======
namespace Katu\Pdo\Expressions;

class Alias extends \Katu\Pdo\Expression {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

	public $name;

	public function __construct($name) {
		$this->name = $name;
	}

	public function getSql(&$context = array()) {
		return $this->name;
	}

}
