<?php

namespace Sexy;

class Fnc extends Expression
{
	public $alias;
	public $arguments;
	public $function;

	public function __construct(Keyword $function, array $arguments = [], Alias $alias = null)
	{
		$this->function = $function;
		$this->arguments = is_array($arguments) ? $arguments : [$arguments];
		$this->alias = $alias;
	}

	public function getSql(&$context = [])
	{
		return " " . trim(strtoupper($this->function->getSql($context))) . "( " . implode(", ", array_map(function ($i) use (&$context) {
			return $i->getSql($context);
		}, $this->arguments)) . " ) " . (!is_null($this->alias) ? " AS " . $this->alias->getSql($context) : null);
	}
}
