<?php

namespace Sexy;

class SQL extends Expression
{
	public $sql;

	public function __construct($sql = null)
	{
		$this->sql = (string) $sql;
	}

	public function getSql(&$context = [])
	{
		return " " . $this->sql . " ";
	}
}
