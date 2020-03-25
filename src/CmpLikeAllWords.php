<?php

namespace Sexy;

class CmpLikeAllWords extends Cmp
{
	public function getSql(&$context = [])
	{
		$wordSqls = [];
		foreach (preg_split('/\s/', trim($this->value->value)) as $pattern) {
			$wordSqls[] = new CmpLike($this->name, '%' . $pattern . '%');
		}

		return (new LgcAnd($wordSqls))->getSql($context);
	}
}
