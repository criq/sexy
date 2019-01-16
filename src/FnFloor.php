<?php

namespace Sexy;

class FnFloor extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('floor'), $arguments, $alias);
	}

}
