<?php

namespace Sexy;

class BindValue extends Expression
{
	const ANONYMOUS_NAME_HANDLE = 'anonymousBindValue';

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
	}

	public function getAnonymousId()
	{
		return static::$anonymousId++;
	}

	public function getSql(&$context = [])
	{
		$useBindValues = (bool) !(isset($context['useBindValues']) && !$context['useBindValues']);

		// Select.
		if ($this->value instanceof Select) {
			$this->value->setOptGetTotalRows(false);

			return $this->value->getSql($context);

		// Value.
		} else {
			if ($useBindValues) {
				// Anonymous assignment.
				if (!$this->name) {
					$this->name = static::ANONYMOUS_NAME_HANDLE . $this->getAnonymousId();
				}

				$context['bindValues'][$this->name] = $this->value;

				return ':' . $this->name;
			} else {
				return "'" . $this->value . "'";
			}
		}
	}
}
