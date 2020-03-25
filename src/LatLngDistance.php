<?php

namespace Sexy;

class LatLngDistance extends Expression
{
	public $alias;
	public $latLng;
	public $latRadColumn;
	public $lngRadColumn;

	public function __construct(Alias $alias, \Katu\Pdo\Column $latRadColumn, \Katu\Pdo\Column $lngRadColumn, \Katu\Types\Geo\TLatLng $latLng)
	{
		$this->alias = $alias;
		$this->latRadColumn = $latRadColumn;
		$this->lngRadColumn = $lngRadColumn;
		$this->latLng = $latLng;
	}

	public function getSql(&$context = [])
	{
		$latRad = $this->latLng->lat->getRad();
		$lngRad = $this->latLng->lng->getRad();

		$latRadOrigin = new Param($latRad);
		$lngRadOrigin = new Param($lngRad);

		$latRadTarget = $this->latRadColumn;
		$lngRadTarget = $this->lngRadColumn;

		$temp = " POW(SIN(( " . $latRadTarget->getSql($context) . " - " . $latRadOrigin->getSql($context) . " ) / 2), 2) + COS(" . $latRadOrigin->getSql($context) . ") * COS(" . $latRadTarget->getSql($context) . ") * POW(SIN(( " . $lngRadTarget->getSql($context) . " - " . $lngRadOrigin->getSql($context) . " ) / 2), 2) ";

		return " ((12736 * ATAN2(SQRT($temp), SQRT(1 - $temp))) * 1000) AS " . $this->alias->getSql($context);
	}
}
