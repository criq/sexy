<?php

namespace Sexy;

class FncCos extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('cos'), $arguments, $alias);
	}

}
