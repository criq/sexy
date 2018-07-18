<?php

namespace Sexy;

class FnCoalesce extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('coalesce'), $arguments, $alias);
	}

}
