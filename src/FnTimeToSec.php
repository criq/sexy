<?php

namespace Sexy;

class FnTimeToSec extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('time_to_sec'), $arguments, $alias);
	}

}
