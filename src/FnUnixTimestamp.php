<?php

namespace Sexy;

class FnUnixTimestamp extends Fn {

	public function __construct(array $arguments = [], Alias $alias = null) {
		return parent::__construct(new Keyword('unix_timestamp'), $arguments, $alias);
	}

}
