<?php

namespace Sexy;

class AllTableColumns extends Expression
{
	public $table;

	public function __construct(\Katu\PDO\Table $table)
	{
		$this->table = $table;
	}

	public function getSql(&$context = [])
	{
		return implode(".", [
			$this->table->getSql($context),
			"*",
		]);
	}
}
