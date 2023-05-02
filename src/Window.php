<?php

namespace Sexy;

class Window extends Expression
{
	public $orderBy;
	public $partition;

	public function __construct($partition, $orderBy = null)
	{
		$this->partition = $partition instanceof Expression ? [$partition] : $partition;
		$this->orderBy = $orderBy instanceof Expression ? [$orderBy] : $orderBy;
	}

	public function getSql(&$context = [])
	{
		$sql = null;

		if ($this->partition) {
			$partitionBySql = trim(implode(" , ", array_map(function ($e) use ($context) {
				return $e->getSql($context);
			}, $this->partition)));
			if ($partitionBySql) {
				$sql .= " PARTITION BY {$partitionBySql} ";
			}
		}

		if ($this->orderBy) {
			$orderBySql = trim(implode(" , ", array_map(function ($e) use ($context) {
				return $e->getSql($context);
			}, $this->orderBy)));
			if ($orderBySql) {
				$sql .= " ORDER BY {$orderBySql} ";
			}
		}

		return $sql;
	}
}
