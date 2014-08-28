<?php

<<<<<<< HEAD
namespace Sexy;

class CmpNotEq extends \Sexy\Cmp {
=======
namespace Katu\Pdo\Expressions;

class CmpNotEq extends \Katu\Pdo\Expressions\Cmp {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

	public function getSql(&$context = array()) {
		return " NOT ( " . $this->name->getSql($context) . " = " . $this->value->getSql($context) . " ) ";
	}

}
