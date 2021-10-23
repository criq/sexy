<?php

namespace Sexy;

use Katu\Pdo\Column;
use Katu\Pdo\Table;

abstract class Command extends Expression
{
	protected $expressions = [];
	protected $flags = [];
	protected $limit;
	protected $page;

	abstract public function getSql(&$context = []): string;

	public function setFlag(string $flag, bool $value): Command
	{
		$this->flags[$flag] = $value;

		return $this;
	}

	public function getFlag(string $flag): bool
	{
		return $this->flags[$flag] ?? false;
	}

	public function addExpression(string $group, Expression $expression): Command
	{
		if (!($this->expressions[$group] ?? null)) {
			$this->expressions[$group] = new ExpressionCollection;
		}

		$this->expressions[$group]->addExpression($expression);

		return $this;
	}

	public function addExpressions(array $expressions = []): Command
	{
		foreach ($expressions as $group => $groupExpressions) {
			foreach ($groupExpressions as $expression) {
				$this->addExpression($group, $expression);
			}
		}

		return $this;
	}

	public function getExpressions(string $group): ExpressionCollection
	{
		return $this->expressions[$group] ?? new ExpressionCollection;
	}

	public function getParams(): array
	{
		$this->getSql($context);

		return $context['params'] ?? [];
	}

	public function getAvailableTables(): array
	{
		$tables = [];

		foreach ($this->getExpressions('from') as $from) {
			if ($from instanceof \Katu\PDO\TableBase) {
				$tables[] = $from;
			}
		}

		foreach ($this->getExpressions('join') as $join) {
			if (($join->join ?? null) instanceof \Katu\PDO\TableBase) {
				$tables[] = $join->join;
			}
		}

		return $tables;
	}

	public function getAvailableTableNames(): array
	{
		return array_map(function ($table) {
			return $table->getName();
		}, $this->getAvailableTables());
	}

	/**************************************************************************
	 * Select.
	 */
	public function select(Expression $expression): Command
	{
		if ($expression instanceof Table) {
			$expression = new AllTableColumns($expression);
		}

		$this->addExpression('select', $expression);

		return $this;
	}

	/**************************************************************************
	 * From.
	 */
	public function from(Expression $expression): Command
	{
		$this->addExpression('from', $expression);

		return $this;
	}

	/**************************************************************************
	 * Join.
	 */
	public function join(Expression $expression): Command
	{
		$this->addExpression('join', $expression);

		return $this;
	}

	public function joinColumns(Column $ownColumn, Column $foreignColumn): Command
	{
		return $this->join(new Join($foreignColumn->getTable(), new CmpEq($ownColumn, $foreignColumn)));
	}

	public function leftJoinColumns(Column $ownColumn, Column $foreignColumn): Command
	{
		return $this->join(new Join($foreignColumn->getTable(), new CmpEq($ownColumn, $foreignColumn), new Keyword("left")));
	}

	/**************************************************************************
	 * Where.
	 */
	public function where(Expression $expression): Command
	{
		$this->addExpression('where', $expression);

		return $this;
	}

	/**************************************************************************
	 * Group by.
	 */
	public function groupBy(Expression $expression): Command
	{
		$this->addExpression('groupBy', $expression);

		return $this;
	}

	/**************************************************************************
	 * Having.
	 */
	public function having(Expression $expression): Command
	{
		$this->addExpression('having', $expression);

		return $this;
	}

	/**************************************************************************
	 * Order by.
	 */
	public function orderBy(Expression $expression): Command
	{
		$this->addExpression('orderBy', $expression);

		return $this;
	}

	/**************************************************************************
	 * Limit.
	 */
	public function setLimit(?Limit $limit): Command
	{
		$this->limit = $limit;

		return $this;
	}

	public function getLimit(): ?Limit
	{
		return $this->limit;
	}

	public function setPage(?Page $page): Command
	{
		$this->page = $page;

		return $this;
	}

	public function getPage(): ?Page
	{
		return $this->page;
	}
}
