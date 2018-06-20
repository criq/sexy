<?php

namespace Sexy;

class FnDate extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('date'), $arguments, $alias);
	}

}
