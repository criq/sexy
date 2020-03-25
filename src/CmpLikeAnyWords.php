<?php

namespace Sexy;

class CmpLikeAnyWords extends CmpLikeWords
{
	public function getSql(&$context = [])
	{
		return (new LgcOr($this->wordSqls))->getSql($context);
	}
}
