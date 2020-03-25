<?php

namespace Sexy;

class ValuePlaceholder extends Expression
{
	public $placeholder;

	public function __construct($placeholder)
	{
		$this->placeholder = $placeholder;
	}

	public function getSql(&$context = [])
	{
		return ":" . $this->placeholder;
	}
}
