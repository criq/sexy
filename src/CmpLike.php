<?php

namespace Sexy;

class CmpLike extends Cmp {

	public function getSql(&$context = []) {
		return " ( " . $this->name->getSql($context) . " LIKE " . $this->value->getSql($context) . " ) ";
	}

}
