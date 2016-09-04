<?php

namespace Sexy;

class FnIfNull extends Fn {

	public function __construct(array $arguments, Alias $alias = null) {
		return parent::__construct(new Keyword('ifnull'), $arguments, $alias);
	}

}
