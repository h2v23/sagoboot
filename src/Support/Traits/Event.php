<?php
namespace SagoBoot\Support\Traits;

if (!defined('SGB_PATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit;
}

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