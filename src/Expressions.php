<?php

namespace Sexy;

class Expressions extends \ArrayObject
{
	public function getSql($delimiter, &$context)
	{
		return implode($delimiter, array_map(function ($i) use (&$context) {
			return $i->getSql($context);
		}, $this->getArrayCopy()));
	}
}
