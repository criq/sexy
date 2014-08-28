<?php

<<<<<<< HEAD
namespace Sexy;
=======
namespace Katu\Pdo\Expressions;
>>>>>>> 0786f8f5c55227a0b06cbc3295cab4856a76cb8d

class LeftJoin extends Join {

	public function getSql(&$context = array()) {
		return " LEFT JOIN " . $this->join->getSql($context) . " ON ( " . $this->conditions->getSql($context) . " ) " . ($this->alias ? " AS " . $this->alias : NULL);
	}

}
