<?php

<<<<<<< HEAD
namespace Sexy;

class LgcOr extends Expression {
=======
namespace Katu\Pdo\Expressions;

class LgcOr extends \Katu\Pdo\Expression {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

	public $expressions = array();

	public function __construct($expressions) {
		$this->expressions = $expressions;
	}

	public function getSql(&$context = array()) {
		return implode(" OR ", array_map(function($i) use(&$context) {
			return " ( " . $i->getSql($context) . " ) ";
		}, $this->expressions));
	}

}
