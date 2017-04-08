<?php

namespace Sexy;

class FnDay extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('day'), $arguments, $alias);
	}

}
