<?php

namespace Sexy;

class CmpLikeAllWordsStart extends Cmp
{
	public function getSql(&$context = [])
	{
		return new CmpRegexp($this->name, implode(array_values(array_filter(array_map(function (string $i) {
			return "\\\b{$i}.*";
		}, preg_split("/\s/", $this->value->value))))));
	}
}
