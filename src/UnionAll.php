<?php

namespace Sexy;

class UnionAll extends Union {

	public $arguments;

	public function getSql(&$context = []) {
		$sqls = [];

		foreach ($this->arguments as $argument) {
			$sqls[] = " ( " . $argument->getSql($context) . " ) ";
		}

		return implode(" UNION ALL ", $sqls);
	}

}
