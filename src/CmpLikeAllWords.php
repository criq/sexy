<?php

namespace Sexy;

class CmpLikeAllWords extends CmpLikeWords
{
	public function getSql(&$context = [])
	{
		return (new LgcAnd($this->wordSqls))->getSql($context);
	}
}
