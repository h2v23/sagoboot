<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

//Define constant
defined('SGB_DEBUG') OR define('SGB_DEBUG', false);
defined('SGB_PATH') OR define('SGB_PATH', dirname(__FILE__) . '/');

/**
 * @param null $make
 * @param array $parameters
 * @return mixed|\SagoBoot\Framework\Illuminate\Container\Container
 * @throws ReflectionException
 * @throws \SagoBoot\Framework\Illuminate\Container\BindingResolutionException
 */
function sgb_app($make = null, $parameters = []) {
    if (is_null($make)) {
        /** @var \SagoBoot\Application */
        return \SagoBoot\Framework\Illuminate\Container\Container::getInstance();
    }
    /** @var \SagoBoot\Application */
    return \SagoBoot\Framework\Illuminate\Container\Container::getInstance()->make($make, $parameters);
}

function sgb_helper($name, $parameters = []) {
	return sgb_app($name . 'Helper', $parameters);
}

function sgb_event($event, $payload = []) {
    /** @var \SagoBoot\EventsHelper::fire */
    return sgb_helper('Events')->fire($event, $payload);
}

function sgb_add_event($events, $listener, $weight = 0) {
    /** @var \SagoBoot\EventsHelper::listen */
    return sgb_helper('Events')->addEvent($events, $listener, $weight);
}

function sgb_filter($filter, $body = '', $payload = [], $haltable = false) {
	/** @var \SagoBoot\FiltersHelper::fire */
	return sgb_helper('Filters')->fire($filter, $body, $payload, $haltable);
}

function sgb_add_filter($filterName, $methodCallback, $weight = 0) {
    /** @var \SagoBoot\FiltersHelper::fire */
    return sgb_helper('Filters')->addFilter($filterName, $methodCallback, $weight);
}

/**
 * @return \SagoBoot\Cli
 * @throws ReflectionException
 * @throws \SagoBoot\Framework\Illuminate\Container\BindingResolutionException
 */
function sgb_cli()
{
	return sgb_app('Cli');
}