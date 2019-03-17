<?php

namespace Sexy;

class FnReplace extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('replace'), $arguments, $alias);
	}

}
