<?php

namespace Sexy;

class CmpGreaterThan extends \Sexy\Cmp {

	public function getSql(&$context = array()) {
		return " ( " . $this->name->getSql($context) . " > " . $this->value->getSql($context) . " ) ";
	}

}
