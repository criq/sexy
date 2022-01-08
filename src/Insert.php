<?php

namespace Sexy;

class Insert extends Command
{
	/**************************************************************************
	 * Into.
	 */
	public function into(Expression $expression): Command
	{
		$this->addExpression("into", $expression);

		return $this;
	}

	public function columns(Expression $expression): Command
	{
		$this->addExpression("columns", $expression);

		return $this;
	}

	/**************************************************************************
	 * SQL.
	 */
	public function getSql(&$context = []) : string
	{
		$sql = " INSERT ";

		if (count($this->getExpressions("into"))) {
			$sql .= " INTO " . $this->getExpressions("into")->getSql($context);
		}

		if (count($this->getExpressions("columns"))) {
			$sql .= " ( " . $this->getExpressions("columns")->getSql($context) . " ) ";
		}

		if (count($this->getExpressions("select"))) {
			$sql .= $this->getExpressions("select")[0]->getSql($context);
		}

		return $sql;
	}
}
