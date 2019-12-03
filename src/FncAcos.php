<?php

namespace Sexy;

class FncAcos extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('acos'), $arguments, $alias);
	}

}
