<?php

namespace Sexy;

class FnLength extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('length'), $arguments, $alias);
	}

}
