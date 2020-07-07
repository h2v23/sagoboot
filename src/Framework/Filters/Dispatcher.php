<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Framework\Filters;

use SagoBoot\Framework\Application;
use SagoBoot\Framework\Contracts\Events\Dispatcher as DispatcherContract;
use SagoBoot\Framework\Events\Dispatcher as EventsDispatcher;

/**
 * Class Dispatcher
 * @package SagoBoot\Framework\Filters
 */
class Dispatcher extends EventsDispatcher implements DispatcherContract
{
    /**
     * Fire an event and call the listeners.
     *
     * @param string|object $filter
     * @param string $body
     * @param mixed $payload
     * @param bool $haltable
     *
     * @return array|null
     * @throws \ReflectionException
     * @throws \SagoBoot\Framework\Container\BindingResolutionException
     */
    public function fire($filter, $body = '', $payload = [], $haltable = false)
    {
        $response = $body;
        /** @var Application $app */
        $app = sgb_app();
        $this->firing[] = $filter;
        foreach ($this->getListeners($filter) as $listener) {
            $response = $app->call($listener, ['response' => $response, 'payload' => $payload]);
            if ($haltable || strpos($filter, ':haltable') !== false) {
                if (!$response) {
                    return $response;
                }
            }
        }

        array_pop($this->firing);

        return $response;
    }
}
