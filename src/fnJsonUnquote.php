<?php

namespace Sexy;

class FnJsonUnquote extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('json_unquote'), $arguments, $alias);
	}

}
