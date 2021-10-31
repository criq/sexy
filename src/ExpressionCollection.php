<?php

namespace Sexy;

class ExpressionCollection extends Expression implements \Countable, \Iterator
{
	protected $iteratorPosition = 0;

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

	public function rewind()
	{
		$this->iteratorPosition = 0;
	}

	public function current()
	{
		return $this->expressions[$this->iteratorPosition];
	}

	public function key()
	{
		return $this->iteratorPosition;
	}

	public function next()
	{
		++$this->iteratorPosition;
	}

	public function valid()
	{
		return isset($this->expressions[$this->iteratorPosition]);
	}
}
