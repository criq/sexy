<?php

namespace Sexy;

class FnMin extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('min'), $arguments, $alias);
	}

}
