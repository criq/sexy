<?php

namespace Sexy;

class NullValue extends Expression
{
	public function getSql(&$context = [])
	{
		return " NULL ";
	}
}
