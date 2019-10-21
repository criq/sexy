<?php

namespace Sexy;

class FnJsonObject extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('json_object'), $arguments, $alias);
	}

}
