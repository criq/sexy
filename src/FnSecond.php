<?php

namespace Sexy;

class FnSecond extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('second'), $arguments, $alias);
	}

}
