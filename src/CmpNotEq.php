<?php

namespace Sexy;

class CmpNotEq extends Cmp {

	public function getSql(&$context = []) {
		return " NOT ( " . $this->name->getSql($context) . " = " . $this->value->getSql($context) . " ) ";
	}

}
