<?php

namespace Sexy;

class Cast extends Expression
{
	public $alias;
	public $expression;
	public $type;

	public function __construct(Keyword $type, Expression $expression, Alias $alias = null)
	{
		$this->type       = $type;
		$this->expression = $expression;
		$this->alias      = $alias;
	}

	public function getSql(&$context = [])
	{
		return " CAST( " . $this->expression->getSql($context) . " AS " . strtoupper($this->type->getSql($context)) . " ) " . (!is_null($this->alias) ? " AS " . $this->alias->getSql($context) : null);
	}
}
