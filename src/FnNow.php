<?php

namespace Sexy;

class FnNow extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('now'), $arguments, $alias);
	}

}