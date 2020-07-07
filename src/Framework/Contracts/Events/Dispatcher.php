<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Framework\Contracts\Events;

/**
 * Interface Dispatcher
 * @package SagoBoot\Framework\Contracts\Events
 */
interface Dispatcher
{
    /**
     * Register an event listener with the dispatcher.
     *
     * @param  string|array $events
     * @param  mixed $listener
     * @param  int $weight
     *
     * @return void
     */
    public function listen($events, $listener, $weight = 0);

    /**
     * Fire an event and call the listeners.
     *
     * @param  string|object $event
     * @param  mixed $payload
     *
     * @return array|null
     */
    public function fire($event, $payload = []);

    /**
     * Remove a set of listeners from the dispatcher.
     *
     * @param  string $event
     *
     * @return void
     */
    public function forget($event);

    /**
     * Remove a set of wildcard listeners from the dispatcher.
     *
     * @param  string $event
     *
     * @return void
     */
    public function forgetWildcard($event);

    /**
     * Get all of the listeners for a given event name.
     *
     * @param  string $eventName
     *
     * @return array
     */
    public function getListeners($eventName);

    /**
     * Return last called event
     *
     * @return string|null
     */
    public function firing();
}
