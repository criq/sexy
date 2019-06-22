<?php

namespace Sexy;

class FnTimeDiff extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('timediff'), $arguments, $alias);
	}

}
