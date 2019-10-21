<?php

namespace Sexy;

class FnTrim extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('trim'), $arguments, $alias);
	}

}
