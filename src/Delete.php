<?php

namespace Sexy;

class Delete extends Command
{
	public function getSql(&$context = []) : string
	{
		$sql = " DELETE ";

		if (count($this->getExpressions('from'))) {
			$sql .= " FROM " . $this->getExpressions('from')->getSql($context);
		}

		if (count($this->getExpressions('where'))) {
			$sql .= " WHERE " . $this->getExpressions('where')->setDelimiter(" AND ")->getSql($context);
		}

		if (count($this->getExpressions('orderBy'))) {
			$sql .= " ORDER BY " . $this->getExpressions('orderBy')->getSql($context);
		}

		if ($this->getLimit()) {
			$sql .= $this->getLimit()->getSql($context);
		} elseif ($this->getPage()) {
			$sql .= " LIMIT " . $this->getPage()->getSql($context);
		}

		return $sql;
	}
}
