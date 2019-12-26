<?php


namespace SagoBoot;


use SagoBoot\Framework\Contracts\Events\Dispatcher;
use SagoBoot\Support\Helper;

interface EventsHelper extends Dispatcher, Helper
{
	public function addEvent($eventName, $methodCallback, $weight = 0);
}