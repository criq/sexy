<?php

namespace Sexy;

abstract class Expression {

	abstract public function getSql(&$context = []);

	public function getSqlWithValues() {
		$context = [
			'useBindValues' => false,
		];

		return $this->getSql($context);
	}

}
