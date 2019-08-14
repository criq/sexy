<?php

namespace Sexy;

class CmpNotLike extends Cmp {

	public function getSql(&$context = []) {
		return " NOT ( " . $this->name->getSql($context) . " LIKE " . $this->value->getSql($context) . " ) ";
	}

}
