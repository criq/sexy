<?php

<<<<<<< HEAD
namespace Sexy;

class CmpEq extends \Sexy\Cmp {
=======
namespace Katu\Pdo\Expressions;

class CmpEq extends \Katu\Pdo\Expressions\Cmp {
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

	public function getSql(&$context = array()) {
		$sql = " ( " . $this->name->getSql($context);
		if (!is_null($this->value)) {
			$sql .= " = " . $this->value->getSql($context);
		}
		$sql .= " ) ";

		return $sql;
	}

}
