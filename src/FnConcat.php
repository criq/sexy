<?php

namespace Sexy;

class FnConcat extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('concat'), $arguments, $alias);
	}

}
