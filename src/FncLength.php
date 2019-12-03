<?php

namespace Sexy;

class FncLength extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('length'), $arguments, $alias);
	}

}
