<?php

namespace Sexy;

class FncJsonObject extends Fnc {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('json_object'), $arguments, $alias);
	}

}
