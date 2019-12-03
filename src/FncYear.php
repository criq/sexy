<?php

namespace Sexy;

class FncYear extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('year'), $arguments, $alias);
	}

}
