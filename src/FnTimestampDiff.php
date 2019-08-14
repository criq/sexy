<?php

namespace Sexy;

class FnTimestampDiff extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('timestampdiff'), $arguments, $alias);
	}

}
