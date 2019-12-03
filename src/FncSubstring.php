<?php

namespace Sexy;

class FncSubstring extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('substring'), $arguments, $alias);
	}

}
