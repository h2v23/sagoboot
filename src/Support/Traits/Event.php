<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Support\Traits;

/**
 * Trait Event
 * @package SagoBoot\Support\Traits
 */
trait Event
{
    /**
     * @param $eventName
     * @param $methodCallback
     * @param int $weight
     * @since 1.0.0
     * @throws \ReflectionException
     */
	public function addEvent($eventName, $methodCallback, $weight = 0)
	{
		/** @var \SagoBoot\EventsHelper $eventHelper */
		$eventHelper = sgb_helper('Events');
		$eventHelper->listen(
			$eventName,
			function () use ($methodCallback, $eventName) {
				$args = func_get_args();
				$args[] = $eventName;
				/**
				 * Let call by default app
				 * @see \SagoBoot\Application::call()
				 */
				if (!method_exists($this, 'call')) {
					return sgb_app()->call($methodCallback, $args);
				}
				return $this->call($methodCallback, $args);
			},
			$weight
		);
	}
}