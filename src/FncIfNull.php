<?php

namespace Sexy;

class FncIfNull extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('ifnull'), $arguments, $alias);
	}

}
