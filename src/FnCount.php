<?php

namespace Sexy;

class FnCount extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('count'), $arguments, $alias);
	}

}
