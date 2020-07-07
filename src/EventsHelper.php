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
 * Interface EventsHelper
 * @package SagoBoot
 */
interface EventsHelper extends Dispatcher, Helper
{
	public function addEvent($eventName, $methodCallback, $weight = 0);
}