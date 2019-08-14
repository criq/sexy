<?php

namespace Sexy;

class FnHour extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('hour'), $arguments, $alias);
	}

}
