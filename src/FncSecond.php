<?php

namespace Sexy;

class FncSecond extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('second'), $arguments, $alias);
	}

}
