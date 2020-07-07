<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot\Sample\Car;

/**
 * Class Car
 * @package SagoBoot\Sample\Car
 */
class Car extends \SagoBoot\Support\DataObject implements CarInterface
{
    const RUNNING = 'running';

    const STOPPED = 'stopped';
    /**
     * @var Fuel
     */
    protected $fuel;

    /**
     * Car constructor.
     * @param Fuel $fuel
     */
    public function __construct(
        Fuel $fuel
    )
    {
        $this->fuel = $fuel;
        parent::__construct([]);
        $this->stop();
    }

    /**
     * @return $this|CarInterface
     */
    public function start(): CarInterface
    {
        $this->setState(self::RUNNING);
        return $this;
    }

    /**
     * @return $this|CarInterface
     */
    public function stop(): CarInterface
    {
        $this->setState(self::STOPPED);
        return $this;
    }

    /**
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->getState()===self::RUNNING;
    }

    /**
     * @return CarInterface
     * @throws \Exception
     */
    public function addFuel(): CarInterface
    {
        try {
            $state = $this->getState();
            $this->stop();

            $this->setState('refuel');
            $this->observerState();

            $this->fuel->get();

            $this->setState($state);
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }

        return $this;
    }

    /**
     * @return $this|CarInterface
     */
    public function observerState() :CarInterface
    {
        sleep(1);
        echo sprintf("Your car is: %s.\n", strtoupper($this->getState()));
        return $this;
    }


    public function __destruct()
    {
        sleep(1);
        echo 'The car was destroyed.';
    }
}