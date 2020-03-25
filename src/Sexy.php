<?php

namespace Sexy;

class Sexy
{
	public static function __callStatic($name, $args)
	{
		$class = new \ReflectionClass("\\Sexy\\" . ucfirst($name));
		return $class->newInstanceArgs($args);
	}

	public static function a()
	{
		return new Alias(...func_get_args());
	}

	public static function aka()
	{
		return new AsAlias(...func_get_args());
	}

	public static function kw()
	{
		return new Keyword(...func_get_args());
	}

	public static function val()
	{
		return new Value(...func_get_args());
	}

	public static function placeholder()
	{
		return new ValuePlaceholder(...func_get_args());
	}

	public static function eq()
	{
		return new CmpEq(...func_get_args());
	}
}
