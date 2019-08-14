<?php

namespace Sexy;

class FnSin extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('sin'), $arguments, $alias);
	}

}
