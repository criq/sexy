<?php

namespace Sexy;

class FncIsNull extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('isnull'), $arguments, $alias);
	}

}
