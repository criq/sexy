<?php

<<<<<<< HEAD
namespace Sexy;

class CmpLike extends \Sexy\Cmp {
=======
namespace Katu\Pdo\Expressions;

class CmpLike extends \Katu\Pdo\Expressions\Cmp {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

	public function getSql(&$context = array()) {
		return " ( " . $this->name->getSql($context) . " LIKE " . $this->value->getSql($context) . " ) ";
	}

}
