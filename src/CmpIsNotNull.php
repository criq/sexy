<?php

namespace Sexy;

class CmpIsNotNull extends CmpIsNull {

	public function getSql(&$context = []) {
		return " NOT ( " . $this->name->getSql($context) . " IS NULL ) ";
	}

}
