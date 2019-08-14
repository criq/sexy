<?php

namespace Sexy;

class FnCos extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('cos'), $arguments, $alias);
	}

}
