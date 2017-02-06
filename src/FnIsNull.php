<?php

namespace Sexy;

class FnIsNull extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('isnull'), $arguments, $alias);
	}

}
