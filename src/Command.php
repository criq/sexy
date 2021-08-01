<?php

namespace Sexy;

use Katu\Pdo\Column;
use Katu\Pdo\Table;

abstract class Command extends Expression
{
	protected $from    = [];
	protected $groupBy = [];
	protected $having  = [];
	protected $join    = [];
	protected $limit;
	protected $orderBy = [];
	protected $page;
	protected $select  = [];
	protected $where   = [];

	abstract public function getSql(&$context = []) : string;

	/**************************************************************************
	 * Select.
	 */
	private function addSelectExpression(Expression $expression)
	{
		// Translate table to all columns.
		if ($expression instanceof Table) {
			$expression = new AllTableColumns($expression);
		}

		$this->select[] = $expression;

		return $this;
	}

	public function select($expressions) : Command
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addSelectExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * From.
	 */
	private function addFromExpression(Expression $expression) : Command
	{
		$this->from[] = $expression;

		return $this;
	}

	public function from($expressions) : Command
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addFromExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Join.
	 */
	private function addJoinExpression(Expression $expression) : Command
	{
		$this->join[] = $expression;

		return $this;
	}

	public function join($expressions) : Command
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addJoinExpression($expression);
		}

		return $this;
	}

	public function joinColumns(Column $ownColumn, Column $foreignColumn) : Command
	{
		return $this->join(new Join($foreignColumn->getTable(), new CmpEq($ownColumn, $foreignColumn)));
	}

	public function leftJoinColumns(Column $ownColumn, Column $foreignColumn) : Command
	{
		return $this->join(new Join($foreignColumn->getTable(), new CmpEq($ownColumn, $foreignColumn), new Keyword("left")));
	}

	/**************************************************************************
	 * Where.
	 */
	private function addWhereExpression(Expression $expression) : Command
	{
		$this->where[] = $expression;

		return $this;
	}

	public function where($expressions) : Command
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addWhereExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Group by.
	 */
	private function addGroupByExpression(Expression $expression) : Command
	{
		$this->groupBy[] = $expression;

		return $this;
	}

	public function groupBy($expressions) : Command
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addGroupByExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Having.
	 */
	private function addHavingExpression(Expression $expression) : Command
	{
		$this->having[] = $expression;

		return $this;
	}

	public function having($expressions) : Command
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addHavingExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Order by.
	 */
	private function addOrderByExpression(Expression $expression) : Command
	{
		$this->orderBy[] = $expression;

		return $this;
	}

	public function orderBy($expressions) : Command
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addOrderByExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Limit.
	 */
	public function setLimit(Limit $limit) : Command
	{
		$this->limit = $limit;

		return $this;
	}

	public function setPage(?Page $page) : Command
	{
		$this->page = $page;

		return $this;
	}

	public function getPage() : ?Page
	{
		return $this->page;
	}

	/**************************************************************************
	 * Options.
	 */
	public function addExpressions($expressions = []) : Command
	{
		if (isset($expressions['select']) && $expressions['select']) {
			$this->select($expressions['select']);
		}

		if (isset($expressions['from']) && $expressions['from']) {
			$this->from($expressions['from']);
		}

		if (isset($expressions['join']) && $expressions['join']) {
			$this->join($expressions['join']);
		}

		if (isset($expressions['where']) && $expressions['where']) {
			$this->where($expressions['where']);
		}

		if (isset($expressions['groupBy']) && $expressions['groupBy']) {
			$this->groupBy($expressions['groupBy']);
		}

		if (isset($expressions['having']) && $expressions['having']) {
			$this->having($expressions['having']);
		}

		if (isset($expressions['orderBy']) && $expressions['orderBy']) {
			$this->orderBy($expressions['orderBy']);
		}

		if (isset($expressions['page']) && $expressions['page']) {
			$this->setPage($expressions['page']);
		}

		return $this;
	}

	public function getParams() : array
	{
		$this->getSql($context);

		return $context['params'] ?? [];
	}

	public function getAvailableTables() : array
	{
		$tables = [];

		foreach ($this->from as $from) {
			if ($from instanceof \Katu\PDO\TableBase) {
				$tables[] = $from;
			}
		}

		foreach ($this->join as $join) {
			if ($join->join instanceof \Katu\PDO\TableBase) {
				$tables[] = $join->join;
			}
		}

		return $tables;
	}

	public function getAvailableTableNames() : array
	{
		return array_map(function ($table) {
			return $table->getName();
		}, $this->getAvailableTables());
	}
}
