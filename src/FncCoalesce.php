<?php

namespace Sexy;

class FncCoalesce extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('coalesce'), $arguments, $alias);
	}

}
