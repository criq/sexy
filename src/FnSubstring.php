<?php

namespace Sexy;

class FnSubstring extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('substring'), $arguments, $alias);
	}

}
