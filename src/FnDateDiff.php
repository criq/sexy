<?php

namespace Sexy;

class FnDateDiff extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('datediff'), $arguments, $alias);
	}

}
