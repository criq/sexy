<?php

namespace Sexy;

class CmpLikeAnyWords extends Cmp
{
	public function getSql(&$context = [])
	{
		$wordSqls = [];
		foreach (preg_split('#\s#', trim($this->value->value)) as $pattern) {
			$wordSqls[] = new CmpLike($this->name, '%' . $pattern . '%');
		}

		return (new LgcOr($wordSqls))->getSql($context);
	}
}
