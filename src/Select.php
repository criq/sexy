<?php

namespace Sexy;

use \Katu\Pdo\Table;
use \Katu\Pdo\Column;

class Select extends Expression {

	public $select   = [];
	public $from     = [];
	public $join     = [];
	public $where    = [];
	public $groupBy  = [];
	public $having   = [];
	public $orderBy  = [];

	private $_optGetTotalRows = true;
	private $_optPage;

	public function __construct(Expression $select = null) {
		if ($select) {
			call_user_func_array([$this, 'select'], func_get_args());
		}

		return $this;
	}

	public function setOptGetTotalRows($bool) {
		$this->_optGetTotalRows = (bool) $bool;
	}

	/**************************************************************************
	 * Select.
	 */

	private function addSelectExpression(Expression $expression) {
		// Translate table to all columns.
		if ($expression instanceof Table) {
			$expression = new Column($expression, "*");
		}

		$this->select[] = $expression;

		return $this;
	}

	public function select(Expression $expression) {
		return $this->addSelectExpression($expression);
	}

	/**************************************************************************
	 * From.
	 */

	private function addFromExpression(Expression $expression) {
		$this->from[] = $expression;

		return $this;
	}

	public function from(Expression $expression) {
		return $this->addFromExpression($expression);
	}

	/**************************************************************************
	 * Join.
	 */

	private function addJoinExpression(Expression $expression) {
		$this->join[] = $expression;

		return $this;
	}

	public function join(Expression $expression) {
		return $this->addJoinExpression($expression);
	}

	public function joinColumns(Column $ownColumn, Column $foreignColumn) {
		return $this->join(new Join($foreignColumn->getTable(), new CmpEq($ownColumn, $foreignColumn)));
	}

	public function joinSubquery(Column $ownColumn, $subqueryAlias, $foreignColumn, Select $subquery, Keyword $direction = null) {
		return $this->join(new Join($subquery, new CmpEq($ownColumn, new Alias($subqueryAlias . "." . $foreignColumn)), $direction, new Alias($subqueryAlias)));
	}

	public function leftJoinSubquery(Column $ownColumn, $subqueryAlias, $foreignColumn, Select $subquery) {
		return $this->joinSubquery($ownColumn, $subqueryAlias, $foreignColumn, $subquery, new Keyword("LEFT"));
	}

	/**************************************************************************
	 * Where.
	 */

	private function addWhereExpression(Expression $expression) {
		$this->where[] = $expression;

		return $this;
	}

	public function where(Expression $expression) {
		return $this->addWhereExpression($expression);
	}

	public function whereOr(array $expressions) {
		return $this->where(new LgcOr($expressions));
	}

	/**************************************************************************
	 * Group by.
	 */

	private function addGroupByExpression(Expression $expression) {
		$this->groupBy[] = $expression;

		return $this;
	}

	public function groupBy(Expression $expression) {
		return $this->addGroupByExpression($expression);
	}

	/**************************************************************************
	 * Having.
	 */

	private function addHavingExpression(Expression $expression) {
		$this->having[] = $expression;

		return $this;
	}

	public function having(Expression $expression) {
		$this->addHavingExpression($expression);

		return $this;
	}

	/**************************************************************************
	 * Order by.
	 */

	private function addOrderByExpression(Expression $expression) {
		$this->orderBy[] = $expression;

		return $this;
	}

	public function orderBy(Expression $expression) {
		$this->addOrderByExpression($expression);

		return $this;
	}

	/**************************************************************************
	 * Limit.
	 */

	public function setPage($page) {
		$this->_optPage = $page;

		return $this;
	}

	public function getPage() {
		return $this->_optPage;
	}

	/**************************************************************************
	 * Options.
	 */

	public function setOptions($options = []) {
		if (isset($options['select'])) {
			$this->select($options['select']);
		}

		if (isset($options['groupBy'])) {
			$this->groupBy($options['groupBy']);
		}

		if (isset($options['orderBy'])) {
			$this->orderBy($options['orderBy']);
		}

		if (isset($options['page'])) {
			$this->setPage($options['page']);
		}

		return $this;
	}

	/**************************************************************************
	 * SQL.
	 */

	public function getSql(&$context = []) {
		$sql = " SELECT ";

		if ($this->_optGetTotalRows) {
			$sql .= " SQL_CALC_FOUND_ROWS ";
		}

		if ($this->select) {
			$sql .= implode(", ", array_map(function($i) use(&$context) {
				return $i->getSql($context);
			}, $this->select));
		} else {
			$sql .= " * ";
		}

		if ($this->from) {
			$sql .= " FROM " . implode(", ", array_map(function($i) use(&$context) {
				return $i->getSql($context);
			}, $this->from));
		}

		if ($this->join) {
			$sql .= implode(" ", array_map(function($i) use(&$context) {
				return $i->getSql($context);
			}, $this->join));
		}

		if ($this->where) {
			$sql .= " WHERE " . implode(" AND ", array_map(function($i) use(&$context) {
				return $i->getSql($context);
			}, $this->where));
		}

		if ($this->groupBy) {
			$sql .= " GROUP BY " . implode(", ", array_map(function($i) use(&$context) {
				return $i->getSql($context);
			}, $this->groupBy));
		}

		if ($this->having) {
			$sql .= " HAVING " . implode(" AND ", array_map(function($i) use(&$context) {
				return $i->getSql($context);
			}, $this->having));
		}

		if ($this->orderBy) {
			$sql .= " ORDER BY " . implode(", ", array_map(function($i) use(&$context) {
				return $i->getSql($context);
			}, $this->orderBy));
		}

		if ($this->_optPage) {
			$sql .= " LIMIT " . $this->_optPage->getSql($context);
		}

		return $sql;
	}

	public function getBindValues() {
		$this->getSql($context);

		return isset($context['bindValues']) ? (array) $context['bindValues'] : [];
	}

}
