<?php

namespace Sexy;

class CmpLessThanOrEqual extends Cmp {

	public function getSql(&$context = []) {
		return " ( " . $this->name->getSql($context) . " <= " . $this->value->getSql($context) . " ) ";
	}

}
