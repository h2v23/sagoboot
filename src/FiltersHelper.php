<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot;


use SagoBoot\Framework\Contracts\Events\Dispatcher;
use SagoBoot\Support\Helper;

/**
 * Interface FiltersHelper
 * @package SagoBoot
 */
interface FiltersHelper extends Dispatcher, Helper
{
	public function addFilter($filterName, $methodCallback, $weight = 0);
}