<?php
/**
 * @author h2v23
 * @package SagoBoot | The mini-framework for scalable PHP application
 */

namespace SagoBoot\Framework\Illuminate\Filters;

if (!defined('SGB_PATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit;
}

use SagoBoot\Framework\Application;
use SagoBoot\Framework\Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use SagoBoot\Framework\Illuminate\Events\Dispatcher as EventsDispatcher;

/**
 * Class Dispatcher.
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
     * @throws \SagoBoot\Framework\Illuminate\Container\BindingResolutionException
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
