<?php

namespace Sexy;

class Value extends Expression
{
	public $name;
	public $value;
	public static $anonymousId = 0;

	public function __construct()
	{
		// var_dump(func_get_args());

		if (count(func_get_args()) == 1) {
			$this->name = null;
			$this->value = func_get_arg(0);
		} elseif (count(func_get_args()) == 2) {
			$this->name = func_get_arg(0);
			$this->value = func_get_arg(1);
		}

		if (!$this->name) {
			$this->name = implode('_', [
				'anonymousValue',
				static::$anonymousId++,
			]);
		}
	}

	public function getSql(&$context = [])
	{
		$useValues = (bool)!(isset($context['useValues']) && !$context['useValues']);

		// Select.
		if ($this->value instanceof Select) {
			$this->value->setOptGetTotalRows(false);

			return $this->value->getSql($context);

		// Value.
		} else {
			if ($useValues) {
				$context['values'][$this->name] = $this->value;

				return ":" . $this->name;
			} else {
				return "'" . $this->value . "'";
			}
		}
	}
}
