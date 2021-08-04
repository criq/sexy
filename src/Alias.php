<?php

namespace Sexy;

class Alias extends Expression
{
	public $alias;

	public function __construct($alias = null)
	{
		$this->alias = $alias instanceof static ? $alias->getAlias() : (string)$alias;
	}

	public function getAlias()
	{
		return $this->alias;
	}

	public function getSql(&$context = [])
	{
		return implode('.', array_map(function ($i) {
			$res = "`" . $i . "`";
			if ($res == '`*`') {
				$res = '*';
			}

			return $res;
		}, explode('.', trim($this->alias, "`"))));
	}
}
