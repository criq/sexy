<?php

namespace Sexy;

class CmpContains extends CmpLike
{
	public function __construct(Expression $name, $value = null)
	{
		return parent::__construct($name, '%' . $value . '%');
	}
}
