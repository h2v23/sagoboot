<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Sample\Car;

/**
 * Interface CarInterface
 * @package SagoBoot\Sample\Car
 */
interface CarInterface extends \SagoBoot\Support\Singleton
{
    /**
     * @return mixed
     */
    public function start() :CarInterface;

    /**
     * @return CarInterface
     */
    public function stop() :CarInterface;

    /**
     * @return bool
     */
    public function isRunning() :bool;

    /**
     * @return CarInterface
     */
    public function addFuel() :CarInterface;

    /**
     * @return CarInterface
     */
    public function observerState() : CarInterface;
}