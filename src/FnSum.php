<?php

namespace Sexy;

class FnSum extends Fn {

	public function __construct(array $arguments, Alias $alias = null) {
		return parent::__construct(new Keyword('sum'), $arguments, $alias);
	}

}
