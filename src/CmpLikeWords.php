<?php

namespace Sexy;

abstract class CmpLikeWords extends Cmp
{
	public $wordSqls = [];

	public function __construct(Expression $name, $value = null)
	{
		parent::__construct($name, $value);

		foreach (preg_split('/\s/', trim($this->value->value)) as $pattern) {
			$this->wordSqls[] = new CmpLike($this->name, '%' . $pattern . '%');
		}
	}
}
