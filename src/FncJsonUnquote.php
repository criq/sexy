<?php

namespace Sexy;

class FncJsonUnquote extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('json_unquote'), $arguments, $alias);
	}

}
