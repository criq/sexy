<?php

namespace Sexy;

class FnWeekday extends Fn {

	public function __construct(array $arguments, Alias $alias = null) {
		return parent::__construct(new Keyword('weekday'), $arguments, $alias);
	}

}
