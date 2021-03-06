<?php

namespace Sexy;

class LeftJoin extends Join {

	public function getSql(&$context = array()) {
		return " LEFT JOIN " . $this->join->getSql($context) . " ON ( " . $this->conditions->getSql($context) . " ) " . ($this->alias ? " AS " . $this->alias : null);
	}

}
