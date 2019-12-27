<?php

namespace Sexy;

class Sexy {

	static function __callStatic($name, $args) {
		$class = new \ReflectionClass("\\Sexy\\" . ucfirst($name));
		return $class->newInstanceArgs($args);
	}

	static function a() {
		return call_user_func_array('static::Alias', func_get_args());
	}

	static function aka() {
		return call_user_func_array('static::AsAlias', func_get_args());
	}

	static function kw() {
		return call_user_func_array('static::Keyword', func_get_args());
	}

	static function val() {
		return call_user_func_array('static::BindValue', func_get_args());
	}

	static function placeholder() {
		return call_user_func_array('static::BindValuePlaceholder', func_get_args());
	}

	static function eq() {
		return call_user_func_array('static::CmpEq', func_get_args());
	}

}
