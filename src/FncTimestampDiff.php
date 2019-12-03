<?php

namespace Sexy;

class FncTimestampDiff extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('timestampdiff'), $arguments, $alias);
	}

}
