<?php

namespace Sexy;

class FnMonth extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('month'), $arguments, $alias);
	}

}
