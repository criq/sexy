<?php

namespace Sexy;

class FnDateAdd extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('date_add'), $arguments, $alias);
	}

}
