<?php

namespace Sexy;

class FncIf extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('if'), $arguments, $alias);
	}

}
