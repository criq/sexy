<?php

namespace Sexy;

abstract class Expression {

	abstract public function getSql(&$context = []);

	public function __toString() {
		return $this->getSqlWithValues();
	}

	public function getSqlWithValues() {
		$context = [
			'useBindValues' => false,
		];

		return $this->getSql($context);
	}

}
