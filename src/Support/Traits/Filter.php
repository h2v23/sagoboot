<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Support\Traits;

/**
 * Trait Filter
 * @package SagoBoot\Support\Traits
 */
trait Filter
{
    /**
     * @param $filterName
     * @param $methodCallback
     * @param int $weight
     * @throws \ReflectionException
     */
	public function addFilter($filterName, $methodCallback, $weight = 0)
	{
		/** @var \SagoBoot\FiltersHelper $filterHelper */
		$filterHelper = sgb_helper('Filters');
		$filterHelper->listen(
			$filterName,
			function () use ($methodCallback, $filterName) {
				$args = func_get_args();
				$args[] = $filterName;
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