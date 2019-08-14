<?php

namespace Sexy;

class FnConcatWs extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('concat_ws'), $arguments, $alias);
	}

}
