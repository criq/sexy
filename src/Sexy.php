<?php

namespace Sexy;

use Katu\Types\TClass;

class Sexy
{
	public static function __callStatic($name, $args)
	{
		$class = new TClass("Sexy\\" . ucfirst($name));
		$className = $class->getName();

		return new $className(...$args);
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

	public static function placeholder()
	{
		return new ParamPlaceholder(...func_get_args());
	}

	public static function eq()
	{
		return new CmpEq(...func_get_args());
	}

	public static function select()
	{
		return new Select(...func_get_args());
	}
}
