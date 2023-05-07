<?php

namespace Sexy;

class Param extends Expression
{
	public $name;
	public $value;
	public static $anonymousId = 0;

	public function __construct()
	{
		if (count(func_get_args()) == 1) {
			$this->name = null;
			$this->value = func_get_arg(0);
		} elseif (count(func_get_args()) == 2) {
			$this->name = func_get_arg(0);
			$this->value = func_get_arg(1);
		}

		if (!$this->name) {
			$this->name = implode('_', [
				'anonymousParam',
				static::$anonymousId++,
			]);
		}
	}

	public function getSQL(&$context = [])
	{
		$useParams = (bool)!(isset($context['useParams']) && !$context['useParams']);

		// Select.
		if ($this->value instanceof Select) {
			$this->value->setGetFoundRows(false);

			return $this->value->getSQL($context);

		// Value.
		} else {
			if ($useParams) {
				$context['params'][$this->name] = $this->value;

				return ":" . $this->name;
			} else {
				return "'" . $this->value . "'";
			}
		}
	}
}
