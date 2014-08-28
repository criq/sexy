<?php

namespace Sexy;

class CmpGreaterThan extends Cmp {

	public function getSql(&$context = array()) {
		return " ( " . $this->name->getSql($context) . " > " . $this->value->getSql($context) . " ) ";
	}

}
