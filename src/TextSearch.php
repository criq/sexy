<?php

namespace Sexy;

/**
 * Diacritic-insensitive text matching for MySQL LIKE / multi-word search.
 *
 * Columns stored as utf8mb4_czech_ci do not fold ě→e under LIKE.
 * utf8mb4_unicode_ci does. {@see CmpLikeWords} applies this automatically;
 * use {@see Sexy::forTextSearch()} for plain {@see CmpLike} on free-text columns.
 */
class TextSearch
{
	public const COLLATION = "utf8mb4_unicode_ci";

	public static function wrap(Expression $expression): Collate
	{
		return new Collate($expression, static::COLLATION);
	}
}
