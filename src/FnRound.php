<?php

namespace Sexy;

class FnRound extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('round'), $arguments, $alias);
	}

}
