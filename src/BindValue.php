<?php

namespace Sexy;

class BindValue extends Expression {

	const ANONYMOUS_NAME_HANDLE = 'anonymousBindValue';
	const ANONYMOUS_NAME_PREG   = '#^anonymousBindValue([0-9]+)$#';

	public $name;
	public $value;

	public function __construct($name = null, $value = null) {
		$this->name  = $name;
		$this->value = $value;
	}

	public function getAnonymousNames($context) {
		if (!isset($context['bindValues'])) {
			return [];
		}

		$names = [];

		foreach ($context['bindValues'] as $name => $value) {
			if (preg_match(static::ANONYMOUS_NAME_PREG, $name)) {
				$names[] = $name;
			}
		}

		return $names;
	}

	public function getFreeAnonymousId($context) {
		$ids = [];

		foreach ($this->getAnonymousNames($context) as $name) {
			preg_match(static::ANONYMOUS_NAME_PREG, $name, $match);
			$ids[] = $match[1];
		}

		if (!$ids) {
			return 1;
		}

		return max($ids) + 1;
	}

	public function getSql(&$context = []) {
		// Select.
		if ($this->value instanceof Select) {

			$this->value->setOptGetTotalRows(false);

			return $this->value->getSql($context);

		// Value.
		} else {

			// Anonymous assignment.
			if (is_null($this->name)) {
				$this->name = static::ANONYMOUS_NAME_HANDLE . $this->getFreeAnonymousId($context);
			}

			$context['bindValues'][$this->name] = $this->value;

			return ':' . $this->name;

		}
	}

}
