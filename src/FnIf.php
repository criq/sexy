<?php

namespace Sexy;

class FnIf extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('if'), $arguments, $alias);
	}

}
