<?php

namespace Sexy;

class ExpressionCollection extends Expression implements \Countable
{
	public function __construct(array $expressions = [], string $delimiter = ", ")
	{
		$this->expressions = $expressions;
		$this->delimiter = $delimiter;
	}

	public function addExpression(Expression $expression): ExpressionCollection
	{
		$this->expressions[] = $expression;

		return $this;
	}

	public function getExpressions(): array
	{
		return $this->expressions;
	}

	public function setDelimiter(string $value): ExpressionCollection
	{
		$this->delimiter = $value;

		return $this;
	}

	public function getDelimiter(): string
	{
		return $this->delimiter;
	}

	public function getSql(&$context = [])
	{
		return implode($this->getDelimiter(), array_map(function ($i) use (&$context) {
			return $i->getSql($context);
		}, $this->getExpressions()));
	}

	public function count(): int
	{
		return count($this->getExpressions());
	}
}
