<?php

namespace Sexy;

class ParamCollection extends Expression
{
	public $params = [];

	public function add($param)
	{
		$this->params[] = $param;
	}

	public function getSql(&$context = [])
	{
		$items = [];
		foreach ($this->params as $param) {
			$items[] = $param->getSql($context);
		}

		return implode(", ", $items);
	}
}
