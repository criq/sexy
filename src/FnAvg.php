<?php

namespace Sexy;

class FnAvg extends Fn {

	public function __construct(array $arguments, Alias $alias = null) {
		return parent::__construct(new Keyword('avg'), $arguments, $alias);
	}

}
