<?php

namespace Sexy;

class JsonPath extends Expression {

	public $jsonPath;

	public function __construct($jsonPath = null) {
		$this->jsonPath = (string)ltrim($jsonPath, "$.");
	}

	public function getSql(&$context = []) {
		return new BindValue("$." . $this->jsonPath);
	}

}
