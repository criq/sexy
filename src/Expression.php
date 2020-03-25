<?php

namespace Sexy;

abstract class Expression
{
	abstract public function getSql(&$context = []);

	public function getSqlWithValues()
	{
		$context = [
			'useParams' => false,
		];

		return $this->getSql($context);
	}

	public function __toString()
	{
		return $this->getSqlWithValues();
	}
}
