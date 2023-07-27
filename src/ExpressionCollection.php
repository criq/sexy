<?php

namespace Sexy;

class ExpressionCollection extends Expression implements \ArrayAccess, \Countable, \Iterator
{
	protected $iteratorPosition = 0;
	protected $expressions;
	protected $delimiter;

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

	public function offsetExists($offset)
	{
		return isset($this->expressions[$offset]);
	}

	public function offsetGet($offset)
	{
		return $this->expressions[$offset];
	}

	public function offsetSet($offset, $value)
	{
		$this->expressions[$offset] = $value;
	}

	public function offsetUnset($offset)
	{
		unset($this->expressions[$offset]);
	}

	public function count(): int
	{
		return count($this->getExpressions());
	}

	public function rewind(): void
	{
		$this->iteratorPosition = 0;
	}

	public function current(): mixed
	{
		return $this->expressions[$this->iteratorPosition];
	}

	public function key(): mixed
	{
		return $this->iteratorPosition;
	}

	public function next(): void
	{
		++$this->iteratorPosition;
	}

	public function valid(): bool
	{
		return isset($this->expressions[$this->iteratorPosition]);
	}
}
