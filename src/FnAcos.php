<?php

namespace Sexy;

class FnAcos extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('acos'), $arguments, $alias);
	}

}
