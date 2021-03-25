<?php

namespace Sexy;

class Page
{
	const DEFAULT_PAGE = 1;
	const DEFAULT_PERPAGE = 50;

	public $perPage = self::DEFAULT_PERPAGE;
	public $page = self::DEFAULT_PAGE;

	public function __construct($page = self::DEFAULT_PAGE, $perPage = self::DEFAULT_PERPAGE)
	{
		if (!(int)$perPage) {
			throw new \Exception("Invalid per page.");
		}
		if (!(int)$page) {
			throw new \Exception("Invalid page.");
		}

		$this->perPage = (int)$perPage;
		$this->page = (int)$page;
	}

	public static function createFromOffsetAndLimit($offset, $limit) : Page
	{
		return new static(floor($offset / $limit) + 1, $limit);
	}

	public function getPage() : int
	{
		return (int)$this->page;
	}

	public function getPerPage() : int
	{
		return (int)$this->perPage;
	}

	public function getOffset() : int
	{
		return (int)(($this->page * $this->perPage) - $this->perPage);
	}

	public function getLimit() : int
	{
		return (int)$this->perPage;
	}

	public function getSql(&$context = [])
	{
		$useParams = (bool)!(isset($context['useParams']) && !$context['useParams']);

		if ($useParams) {
			$context['params']['pageOffset'] = $this->getOffset();
			$context['params']['pageLimit']  = $this->getLimit();

			return " :pageOffset, :pageLimit ";
		} else {
			return " " . $this->getOffset() . ", " . $this->getLimit() . " ";
		}
	}
}
