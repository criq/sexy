<?php

namespace Sexy;

class FnAbs extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('abs'), $arguments, $alias);
	}

}
