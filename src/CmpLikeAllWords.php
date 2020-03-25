<?php

namespace Sexy;

class CmpLikeAllWords extends Cmp
{
	public $wordSqls = [];

	public function __construct(Expression $name, $value = null)
	{
		parent::__construct($name, $value);

		foreach (preg_split('/\s/', trim($this->value->value)) as $pattern) {
			$this->wordSqls[] = new CmpLike($this->name, '%' . $pattern . '%');
		}
	}

	public function getSql(&$context = [])
	{
		return (new LgcAnd($this->wordSqls))->getSql($context);
	}
}
