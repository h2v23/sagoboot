<?php
namespace SagoBoot\Traits;

if (!defined('SGB_PATH')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit;
}

trait Filter
{
	/**
	 * @param $filterName
	 * @param $methodCallback
	 * @param int $weight
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