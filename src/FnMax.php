<?php

namespace Sexy;

class FnMax extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('max'), $arguments, $alias);
	}

}
