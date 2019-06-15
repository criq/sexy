<?php

namespace Sexy;

class FnMinute extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('minute'), $arguments, $alias);
	}

}
