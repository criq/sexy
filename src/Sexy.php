<?php

namespace Sexy;

class Sexy {

	static function __callStatic($name, $args) {
		$class = new \ReflectionClass("\\Sexy\\" . $name);
		return $class->newInstanceArgs($args);
	}

	static function a() {
		return static::Alias(...func_get_args());
	}

	static function aka() {
		return static::AsAlias(...func_get_args());
	}

	static function kw() {
		return static::Keyword(...func_get_args());
	}

	static function val() {
		return static::BindValue(...func_get_args());
	}

	static function eq() {
		return static::CmpEq(...func_get_args());
	}

}
