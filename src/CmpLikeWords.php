<?php

namespace Sexy;

abstract class CmpLikeWords extends Cmp
{
	public $wordSqls = [];

	public function __construct(Expression $name, $value = null)
	{
		parent::__construct($name, $value);

		// Leading-wildcard LIKE never uses a BTREE index; fold diacritics so
		// utf8mb4_czech_ci columns match queries typed without accents.
		$searchName = TextSearch::wrap($this->name);

		foreach (preg_split("/\s/", trim($this->value->value)) as $pattern) {
			$this->wordSqls[] = new CmpLike($searchName, "%{$pattern}%");
		}
	}
}
