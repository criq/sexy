<?php

namespace Sexy;

class Sexy {

	static function __callStatic($name, $args) {
<<<<<<< HEAD
		$class = new \ReflectionClass("\\Sexy\\" . ucfirst($name));
=======
		$class = new \ReflectionClass("\\Sexy\\" . $name);
>>>>>>> f099d7a5669b687fbcc8f021d38bd6201dab8a4a
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

	static function eq() {
		return call_user_func_array('static::CmpEq', func_get_args());
	}

}
