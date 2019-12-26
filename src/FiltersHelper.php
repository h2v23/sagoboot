<?php


namespace SagoBoot;


use SagoBoot\Framework\Contracts\Events\Dispatcher;
use SagoBoot\Support\Helper;

interface FiltersHelper extends Dispatcher, Helper
{
	public function addFilter($filterName, $methodCallback, $weight = 0);
}