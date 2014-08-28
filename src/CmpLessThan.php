<?php

namespace Sexy;

class CmpLessThan extends Cmp {

	public function getSql(&$context = array()) {
		return " ( " . $this->name->getSql($context) . " < " . $this->value->getSql($context) . " ) ";
	}

}
