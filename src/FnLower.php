<?php

namespace Sexy;

class FnLower extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('lower'), $arguments, $alias);
	}

}
