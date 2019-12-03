<?php

namespace Sexy;

class FncTimeDiff extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('timediff'), $arguments, $alias);
	}

}
