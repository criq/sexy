<?php

namespace Sexy;

class CmpLike extends \Sexy\Cmp {

	public function getSql(&$context = array()) {
		return " ( " . $this->name->getSql($context) . " LIKE " . $this->value->getSql($context) . " ) ";
	}

}
