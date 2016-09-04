<?php

namespace Sexy;

class FnYear extends Fn {

	public function __construct(array $arguments, Alias $alias = null) {
		return parent::__construct(new Keyword('year'), $arguments, $alias);
	}

}
