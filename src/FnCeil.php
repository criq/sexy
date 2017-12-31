<?php

namespace Sexy;

class FnCeil extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('ceil'), $arguments, $alias);
	}

}
