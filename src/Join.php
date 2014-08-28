<?php

<<<<<<< HEAD
namespace Sexy;

class Join extends Expression {
=======
namespace Katu\Pdo\Expressions;

class Join extends \Katu\Pdo\Expression {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

	public $join;
	public $conditions;
	public $alias;

	public function __construct($join, $conditions, $alias = NULL) {
		$this->join = $join;
		$this->conditions = $conditions;
		$this->alias = $alias;
	}

	public function getSql(&$context = array()) {
		return " JOIN " . $this->join->getSql($context) . " ON ( " . $this->conditions->getSql($context) . " ) " . ($this->alias ? " AS " . $this->alias : NULL);
	}

}
