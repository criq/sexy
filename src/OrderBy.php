<?php

<<<<<<< HEAD
namespace Sexy;

class OrderBy extends Expression {
=======
namespace Katu\Pdo\Expressions;

class OrderBy extends \Katu\Pdo\Expression {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

	public $orderBy;
	public $direction;

	public function __construct($orderBy, $direction = 'ASC') {
		$this->orderBy = $orderBy;
		$this->direction = $direction;
	}

	public function getSql(&$context = array()) {
		return $this->orderBy->getSql($context) . " " . $this->direction;
	}

}
