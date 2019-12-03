<?php

namespace Sexy;

class FncReplace extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('replace'), $arguments, $alias);
	}

}
