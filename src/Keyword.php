<?php

namespace Sexy;

class Keyword extends Expression {

	public $keyword;

	public function __construct($keyword = null) {
		$this->keyword = (string) $keyword;
	}

	public function getSql(&$context = []) {
		return " " . strtoupper($this->keyword) . " ";
	}

}
