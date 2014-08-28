<?php

namespace Sexy;

class CmpNotEq extends \Sexy\Cmp {

	public function getSql(&$context = array()) {
		return " NOT ( " . $this->name->getSql($context) . " = " . $this->value->getSql($context) . " ) ";
	}

}
