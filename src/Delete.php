<?php

namespace Sexy;

class Delete extends Command
{
	public function getSql(&$context = []) : string
	{
		$sql = " DELETE ";

		if ($this->from) {
			$sql .= " FROM " . implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->from));
		}

		if ($this->where) {
			$sql .= " WHERE " . implode(" AND ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->where));
		}

		if ($this->orderBy) {
			$sql .= " ORDER BY " . implode(", ", array_map(function ($i) use (&$context) {
				return $i->getSql($context);
			}, $this->orderBy));
		}

		if ($this->limit) {
			$sql .= $this->limit->getSql($context);
		} elseif ($this->page) {
			$sql .= " LIMIT " . $this->page->getSql($context);
		}

		return $sql;
	}
}
