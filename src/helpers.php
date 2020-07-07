<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

/**
 * @param null $make
 * @param array $parameters
 * @return mixed|\SagoBoot\Framework\Container\Container
 * @throws ReflectionException
 */
function sgb_app($make = null, $parameters = []) {
    if (is_null($make)) {
        /** @var \SagoBoot\Application */
        return \SagoBoot\Framework\Container\Container::getInstance();
    }
    /** @var \SagoBoot\Application */
    return \SagoBoot\Framework\Container\Container::getInstance()->make($make, $parameters);
}

/**
 * @param $name
 * @param array $parameters
 * @return mixed|\SagoBoot\Framework\Container\Container
 * @throws ReflectionException
 */
function sgb_helper($name, $parameters = []) {
	return sgb_app($name . 'Helper', $parameters);
}

/**
 * @param $event
 * @param array $payload
 * @return mixed
 * @throws ReflectionException
 */
function sgb_event($event, $payload = []) {
    /** @var \SagoBoot\EventsHelper::fire */
    return sgb_helper('Events')->fire($event, $payload);
}

/**
 * @param $events
 * @param $listener
 * @param int $weight
 * @return mixed
 * @throws ReflectionException
 */
function sgb_add_event($events, $listener, $weight = 0) {
    /** @var \SagoBoot\EventsHelper::addEvent */
    return sgb_helper('Events')->addEvent($events, $listener, $weight);
}

/**
 * @param $filter
 * @param string $body
 * @param array $payload
 * @param bool $haltable
 * @return mixed
 * @throws ReflectionException
 */
function sgb_filter($filter, $body = '', $payload = [], $haltable = false) {
	/** @var \SagoBoot\FiltersHelper::fire */
	return sgb_helper('Filters')->fire($filter, $body, $payload, $haltable);
}

/**
 * @param $filterName
 * @param $methodCallback
 * @param int $weight
 * @return mixed
 * @throws ReflectionException
 */
function sgb_add_filter($filterName, $methodCallback, $weight = 0) {
    /** @var \SagoBoot\FiltersHelper::fire */
    return sgb_helper('Filters')->addFilter($filterName, $methodCallback, $weight);
}