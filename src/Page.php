<?php

namespace Sexy;

class Page {

	const DEFAULT_PAGE    = 1;
	const DEFAULT_PERPAGE = 50;

	public $perPage = self::DEFAULT_PERPAGE;
	public $page    = self::DEFAULT_PAGE;

	public function __construct($page = self::DEFAULT_PAGE, $perPage = self::DEFAULT_PERPAGE) {
		if (!(int) $perPage) {
			throw new \Exception("Invalid per page.");
		}
		if (!(int) $page) {
			throw new \Exception("Invalid page.");
		}

		$this->perPage = (int) $perPage;
		$this->page    = (int) $page;
	}

	static function createFromOffsetAndLimit($offset, $limit) {
		return new static(floor($offset / $limit) + 1, $limit);
	}

	public function getOffset() {
		return (int) (($this->page * $this->perPage) - $this->perPage);
	}

	public function getLimit() {
		return (int) $this->perPage;
	}

	public function getSql(&$context = []) {
		$useBindValues = (bool) !(isset($context['useBindValues']) && !$context['useBindValues']);

		if ($useBindValues) {

			$context['bindValues']['pageOffset'] = $this->getOffset();
			$context['bindValues']['pageLimit']  = $this->getLimit();

			return " :pageOffset, :pageLimit ";

		} else {

			return " " . $this->getOffset() . ", " . $this->getLimit() . " ";

		}
	}

}
