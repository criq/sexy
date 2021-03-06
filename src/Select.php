<?php

namespace Sexy;

use \Katu\Pdo\Table;
use \Katu\Pdo\Column;

class Select extends Expression
{
	public $select   = [];
	public $from     = [];
	public $join     = [];
	public $where    = [];
	public $groupBy  = [];
	public $having   = [];
	public $orderBy  = [];

	private $optGetTotalRows = true;
	private $optDistinct = false;
	private $optPage;

	public function __construct(Expression $select = null)
	{
		if ($select) {
			call_user_func_array([$this, 'select'], func_get_args());
		}

		return $this;
	}

	public function setOptGetTotalRows($bool)
	{
		$this->optGetTotalRows = (bool) $bool;

		return $this;
	}

	public function setDistinct($bool = true)
	{
		$this->optDistinct = (bool) $bool;

		return $this;
	}

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

	public function select($expressions)
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addSelectExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * From.
	 */

	private function addFromExpression(Expression $expression)
	{
		$this->from[] = $expression;

		return $this;
	}

	public function from($expressions)
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addFromExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Join.
	 */

	private function addJoinExpression(Expression $expression)
	{
		$this->join[] = $expression;

		return $this;
	}

	public function join($expressions)
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addJoinExpression($expression);
		}

		return $this;
	}

	public function joinColumns(Column $ownColumn, Column $foreignColumn)
	{
		return $this->join(new Join($foreignColumn->getTable(), new CmpEq($ownColumn, $foreignColumn)));
	}

	public function leftJoinColumns(Column $ownColumn, Column $foreignColumn)
	{
		return $this->join(new Join($foreignColumn->getTable(), new CmpEq($ownColumn, $foreignColumn), new Keyword("left")));
	}

	public function joinSubquery(Column $ownColumn, $subqueryAlias, $foreignColumn, Expression $subquery, Keyword $direction = null)
	{
		return $this->join(new Join($subquery, new CmpEq($ownColumn, new Alias(implode('.', [$subqueryAlias, $foreignColumn]))), $direction, new Alias($subqueryAlias)));
	}

	public function leftJoinSubquery(Column $ownColumn, $subqueryAlias, $foreignColumn, Expression $subquery)
	{
		return $this->joinSubquery($ownColumn, $subqueryAlias, $foreignColumn, $subquery, new Keyword("left"));
	}

	/**************************************************************************
	 * Where.
	 */

	private function addWhereExpression(Expression $expression)
	{
		$this->where[] = $expression;

		return $this;
	}

	public function where($expressions)
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addWhereExpression($expression);
		}

		return $this;
	}

	public function whereEq($name, $value)
	{
		return $this->addWhereExpression(new CmpEq($name, $value));
	}

	public function whereIn($name, $value)
	{
		return $this->addWhereExpression(new CmpIn($name, $value));
	}

	public function whereOr(array $expressions)
	{
		return $this->where(new LgcOr($expressions));
	}

	/**************************************************************************
	 * Group by.
	 */

	private function addGroupByExpression(Expression $expression)
	{
		$this->groupBy[] = $expression;

		return $this;
	}

	public function groupBy($expressions)
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addGroupByExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Having.
	 */

	private function addHavingExpression(Expression $expression)
	{
		$this->having[] = $expression;

		return $this;
	}

	public function having($expressions)
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addHavingExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Order by.
	 */

	private function addOrderByExpression(Expression $expression)
	{
		$this->orderBy[] = $expression;

		return $this;
	}

	public function resetOrderBy()
	{
		$this->orderBy = [];

		return $this;
	}

	public function orderBy($expressions)
	{
		foreach (is_array($expressions) ? $expressions : [$expressions] as $expression) {
			$this->addOrderByExpression($expression);
		}

		return $this;
	}

	/**************************************************************************
	 * Limit.
	 */

	public function setPage($page)
	{
		$this->optPage = $page;

		return $this;
	}

	public function setForTotal()
	{
		$this->setPage(new Page(1, 1));

		return $this;
	}

	public function getPage()
	{
		return $this->optPage;
	}

	/**************************************************************************
	 * Options.
	 */

	public function addExpressions($expressions = [])
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

		if (isset($expressions['getTotalRows']) && $expressions['getTotalRows']) {
			$this->setOptGetTotalRows(true);
		}

		return $this;
	}

	public function addExpressionArrays($expressionArrays = [])
	{
		foreach ((array) $expressionArrays as $expressions) {
			$this->addExpressions($expressions);
		}

		return $this;
	}

	/**************************************************************************
	 * SQL.
	 */

	public function getSql(&$context = [])
	{
		$sql = " SELECT ";

		if ($this->optDistinct) {
			$sql .= " DISTINCT ";
		}

		if ($this->optGetTotalRows) {
			$sql .= " SQL_CALC_FOUND_ROWS ";
		}

		if ($this->select) {
			$sql .= implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->select));
		} else {
			$sql .= " * ";
		}

		if ($this->from) {
			$sql .= " FROM " . implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->from));
		}

		if ($this->join) {
			$sql .= implode(" ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->join));
		}

		if ($this->where) {
			$sql .= " WHERE " . implode(" AND ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->where));
		}

		if ($this->groupBy) {
			$sql .= " GROUP BY " . implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->groupBy));
		}

		if ($this->having) {
			$sql .= " HAVING " . implode(" AND ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->having));
		}

		if ($this->orderBy) {
			$sql .= " ORDER BY " . implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->orderBy));
		}

		if ($this->optPage) {
			$sql .= " LIMIT " . $this->optPage->getSql($context);
		}

		return $sql;
	}

	public function getBindValues()
	{
		$this->getSql($context);

		return isset($context['bindValues']) ? (array) $context['bindValues'] : [];
	}

	public function getAvailableTables()
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

	public function getAvailableTableNames()
	{
		return array_map(function ($table) {
			return (string)$table;
		}, $this->getAvailableTables());
	}
}
