<?php

namespace Sexy;

abstract class Expression {

	abstract public function getSql(&$context = []);

}
